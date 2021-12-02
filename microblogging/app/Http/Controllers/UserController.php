<?php

namespace App\Http\Controllers;
use App\Models\User;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\DB;
class UserController extends BaseController
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
    $user = Auth::user();
    //
    $userInfo = User::where('id', $user)->get();

    // On transmet les Post à la vue
    return view("users.profile", compact("user"));
    // compact ??
    }

    public function show(User $user)
    {
        return view('users.change', [
            'user' => $user
        ]);
    }
    
    public function edit(User $user)
    {
        return view("users.change", compact("user"));
    }

    
    public function update(Request $request, User $user)
    {
        $rules = [
            //'name' => 'bail|string|max:60',
            "biography" => 'bail',
            'user_img' => 'bail|image|max:2048',
        ];
    
        // Si une nouvelle image est envoyée
        if ($request->has("user_img")) {
            // On ajoute la règle de validation pour "picture"
            $rules["user_img"] = 'bail|image|max:2048';
        }
    
        $request->validate($rules);
    
        // 2. On upload l'image dans "/storage/app/public/posts"
        if ($request->has("user_img")) {
    
            //On supprime l'ancienne image
            Storage::delete($user->user_img);
    
            $chemin_image_user = $request->user_img->store("users");
        }
    
        // 3. On met à jour les informations du Post
        $user->update([
            //"name" => $request->name,
            "user_img" => isset($chemin_image_user) ? $chemin_image_user : $user->user_img,
            "biography" => $request->biography
        ]);
    
        // 4. On affiche le Post modifié : route("posts.show")
        return redirect(route("users.index", $user));
    }
    

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(User $user)
    {
        Storage::delete($user->user_img);
        $user->delete();
        return redirect(route('/register'));
    }
}
