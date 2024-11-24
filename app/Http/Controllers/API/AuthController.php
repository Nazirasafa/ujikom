<?php
   
namespace App\Http\Controllers\API;
   
use Illuminate\Http\Request;
use App\Http\Controllers\BaseController;
use App\Models\User;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\Storage;



   
class AuthController extends BaseController
{
    /**
     * Register api
     *
     * @return \Illuminate\Http\Response
     */
    public function register(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'name' => 'required',
            'email' => 'required|email',
            'password' => 'required',
            'c_password' => 'required|same:password',
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $input = $request->all();
        $input['password'] = bcrypt($input['password']);
        $user = User::create($input);
        $success['token'] =  $user->createToken('MyApp')->plainTextToken;
        $success['id'] =  $user->id;
        $success['name'] =  $user->name;
        $success['email'] =  $user->email;
        $success['role'] =  $user->role;
   
        return $this->sendResponse($success, 'User register successfully.');
    }
   
    /**
     * Login api
     *
     * @return \Illuminate\Http\Response
     */
    public function login(Request $request)
    {
        if(Auth::attempt(['email' => $request->email, 'password' => $request->password])){ 
            $user = Auth::user(); 
            $success['token'] =  $user->createToken('MyApp')->plainTextToken; 
            $success['id'] =  $user->id;
            $success['name'] =  $user->name;
            $success['email'] =  $user->email;
            $success['role'] =  $user->role;
            $success['profile_pic'] =  $user->profile_pic;


   
            return $this->sendResponse($success, 'User login successfully.');
        } 
        else{ 
            return $this->sendError('Unauthorised.', ['error'=>'Unauthorised']);
        } 
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::user(); 
        $imageUrl = str_replace('images/', 'storage/images/', $user->profile_pic);
    
        $validator = Validator::make($request->all(), [
            'profile_pic' => 'sometimes|image|mimes:jpeg,png,jpg,gif,svg',
            'name' => 'sometimes|string|max:255',
            'email' => 'sometimes|email|unique:users,email,' . $user->id,
            'password' => 'sometimes|string|min:6|confirmed',
        ]);
    
        if ($validator->fails()) {
            return $this->sendError('Validation Error.', $validator->errors());
        }
    
        
        if ($request->has('name')) {
            $user->name = $request->name;
        }
    
        if ($request->has('email')) {
            $user->email = $request->email;
        }
    
        if ($request->has('password')) {
            $user->password = bcrypt($request->password);
        }
        
        if ($request->hasFile('profile_pic')) {
            // Delete previous profile picture if it exists
            if ($user->profile_pic && file_exists(storage_path('app/' . $user->profile_pic))) {
                unlink(storage_path('app/' . $user->profile_pic)); // delete the old image
            }
        
            // Store new profile picture in storage/app/images
            $imagePath = $request->file('profile_pic')->store('images', 'public');
            $imageUrl = str_replace('images/', 'storage/images/', $imagePath);

        
            // Update the user profile picture path (use a relative path for easy access)
            $user->profile_pic = $imagePath;
            $user->save();
        }
        
        $user->save();
    
        return $this->sendResponse(['user' => $user, 'profile_pic' => asset($imageUrl)], 'Profile updated successfully.');
    }
    

    public function logout(Request $request)
    { 
        $user = Auth::user();
    
        $user->tokens()->where('id', $user->currentAccessToken()->id)->delete();
    
        return $this->sendResponse([], 'User logged out successfully.');
    }
    


}