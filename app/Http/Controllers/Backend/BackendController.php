<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Models\Logo;
use App\Models\Message;
use App\Models\User;
use Illuminate\Contracts\View\View;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;

class BackendController extends Controller {

    public function index() {
        if ( Auth::user()->usertype == 1 || Auth::user()->usertype == 2 ) {

            return view( 'backend.dashboard' );
        } else {
            return redirect()->route( 'home' );
        }

    }

    public function logo() {
        if ( Auth::user()->usertype == 1 || Auth::user()->usertype == 2 ) {

            $logoInfo = Logo::limit( 3 )->orderBy( 'id', 'DESC' )->get();
            return view( 'backend.logo.logo', compact( 'logoInfo' ) );
        } else {
            return redirect()->route( 'home' );
        }

    }

    public function messages() {
        if ( Auth::user()->usertype == 1 || Auth::user()->usertype == 2 ) {
            // $messageInfo = Message::orderBy( 'id', 'DESC' )->get();
            $messageInfo = Message::join( 'users', 'messages.authId', '=', 'users.id' )
                ->select( 'messages.*', 'users.name as userName', 'users.image as profileImage' )
                ->orderBy( 'messages.id', 'DESC' )
                ->get();
            return view( 'backend.messages.messages', compact( 'messageInfo' ) );
        } else {
            return redirect()->route( 'home' );

        }

    }

    public function updatePicture( Request $request ) {
        $path = 'storage/profileImages/';
        $file = $request->file( 'admin_image' );
        $new_name = 'UIMG_' . date( 'Ymd' ) . uniqid() . '.jpg';

        //Upload new image
        $upload = $file->move( public_path( $path ), $new_name );

        if ( !$upload ) {
            return response()->json( array( 'status' => 0, 'msg' => 'Something went wrong, upload new picture failed.' ) );
        } else {
            //Get Old picture

            // $oldPicture = User::find( Auth::user()->id )->getAttributes()['picture'];
            $oldPicture = Auth::user()->image;

            if ( $oldPicture != '' ) {
                if ( File::exists( public_path( $path . $oldPicture ) ) ) {
                    File::delete( public_path( $path . $oldPicture ) );
                }
            }

            //Update DB
            $update = User::find( Auth::user()->id )->update( array( 'image' => $new_name ) );

            if ( !$upload ) {
                return response()->json( array( 'status' => 0, 'msg' => 'Something went wrong, updating picture in db failed.' ) );
            } else {
                return response()->json( array( 'status' => 1, 'msg' => 'Your profile picture has been updated successfully' ) );
            }
        }
    }

}
