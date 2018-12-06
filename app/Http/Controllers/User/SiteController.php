<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

use Auth;
use Flash;
use Session;

use App\User;
use App\Models\Admin\AdditionalInfo;
use App\Models\Admin\MemberShipPlan;
use App\Models\Admin\Post;
use App\Models\Admin\PostMeta;
use App\Models\Event;
use App\Models\Admin\Follow;


class SiteController extends Controller
{

    public function index()
    {
        $users = User::where('plan_code','premium')->get()->take(5);

        $data = [
            'title'     => 'Home',
            'users'     => $users
        ];

        return view('local.site.index',$data);
    }

    public function feature()
    {
        $users = User::where('plan_code','premium')->get()->take(5);

        $data = [
            'title'     => 'Feature',
            'users'     => $users
        ];

        return view('local.site.feature',$data);
    }

    public function discover()
    {

        $images = [];
        $vedios = [];

        $users = User::where('plan_code','premium')->get()->take(5);
        $posts = Post::whereIn('post_type',['image','vedio'])->orderBy('id','desc')->get()->take(6);

        $count = 0;

        foreach ($posts as $post) 
        {
            if($post->post_type == 'image')
            {
                $postMeta = PostMeta::where('post_id',$post->id)->first();
                $image = json_decode($postMeta->meta_value);
                if(count($images) <= 6)
                {
                    $images = array_merge($images,$image);
                }
            }
            else
            {
                $postMeta = PostMeta::where('post_id',$post->id)->first();

                if(!empty($postMeta))
                {
                    $vedio_info =  json_decode($postMeta->meta_value,true);

                    if($vedio_info['vedio_type'] == 'youtube')
                    {
                        $url = $vedio_info['vedio_url'];
                        if (preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $url, $match)) 
                        {
                            $video_id = $match[1];
                        }
                        $thumbnail_url = "https://img.youtube.com/vi/".$video_id."/sddefault.jpg";
                        $vedio_info['vedio_url'] = "https://www.youtube.com/embed/".$video_id;
                        $vedio_info['image_url'] = $thumbnail_url;
                        if($count <= 6)
                        {
                            $vedios[$count] = $vedio_info;
                            $count++;
                        }
                    }
                    elseif($vedio_info['vedio_type'] == 'dailymotion')
                    {
                        $original_url = $vedio_info['vedio_url'];
                        $lastSegment = basename(parse_url($original_url, PHP_URL_PATH));
                        $url = explode("_", $lastSegment);
                        $thumbnail_url = "http://www.dailymotion.com/thumbnail/video/".$url[0];
                        $vedio_info['vedio_url'] = "https://www.dailymotion.com/embed/video/".$url[0];
                        $vedio_info['image_url'] = $thumbnail_url;
                        if($count <= 6)
                        {
                            $vedios[$count] = $vedio_info;
                            $count++;
                        }
                    }
                    elseif($vedio_info['vedio_type'] == 'vimeo')
                    {
                        $vimeo = $vedio_info['vedio_url'];
                        $vimeoGetID = (int) substr(parse_url($vimeo, PHP_URL_PATH), 1);
                        $url = 'http://vimeo.com/api/v2/video/'.$vimeoGetID.'.php';
                        $contents = @file_get_contents($url);
                        $array = @unserialize(trim($contents));
                        $vedio_info['vedio_url'] = "https://player.vimeo.com/video/".$vimeoGetID;
                        $vedio_info['image_url'] = $array[0]['thumbnail_large'];
                        if($count <= 6)
                        {
                            $vedios[$count] = $vedio_info;
                            $count++;
                        }
                    }
                }

            }
        }

        // echo "<pre>";
        // print_r($vedios);
        // print_r($images);
        // exit;


        $data = [
            'title'     => 'Discover',
            'users'     => $users,
            'images'    => $images,
            'vedios'    => $vedios
        ];

        return view('local.site.discover',$data);
    }


    public function show()
    {
        $users = User::where('plan_code','premium')->get()->take(5);
        $events = Event::whereDate('start', '>=', date('Y-m-d'))->get();

        $data = [
            'title'     => 'Shows',
            'users'     => $users,
            'events'    => $events
        ];


        return view('local.site.shows',$data);   
    }

    public function charts()
    {
        $users_id = [];
        $users = User::where('plan_code','premium')->paginate(4);

        foreach ($users as $user) 
        {
            if($user->hasRole('Talents'))
            {
                array_push($users_id, $user->id);
            }
        }

        $additionalInfo = AdditionalInfo::whereIn('user_id',$users_id)->get();

        $data = [
            'title'             => 'Charts',
            'users'             => $users,
            'additionalInfo'    => $additionalInfo
        ];

        if(Auth::check())
        {
            $follows = Follow::all();
            $followers = [];
            $userz = User::all();
            foreach ($userz as $u) 
            {
                if(Auth::user()->id != $u->id)
                {
                    foreach ($follows as $follow) 
                    {
                        if($follow->follower_id == Auth::user()->id)
                        {
                            if(!in_array($follow->followed_id, $followers))
                            {
                                array_push($followers, $follow->followed_id);
                            }
                        }
                    }
                }
            }

            $data['follows']  = $followers;
        }

        return view('local.site.charts',$data);
    }

    public function pricing()
    {
        $users = User::where('plan_code','premium')->get()->take(5);
        $memberShipPlan = MemberShipPlan::where('code','premium')->first();

        $data = [
            'title'             => 'Pricing',
            'users'             => $users,
            'memberShipPlan'    => $memberShipPlan
        ];

        return view('local.site.pricing',$data);
    }

    public function about_us()
    {
        $users = User::where('plan_code','premium')->get()->take(5);

        $data = [
            'title'     => 'About us',
            'users'     => $users
        ];

        return view('local.site.about_us',$data);
    }

    public function conditions()
    {
        $users = User::where('plan_code','premium')->get()->take(5);

        $data = [
            'title'     => 'Term n Conditions',
            'users'     => $users
        ];

        return view('local.site.term-n-condition',$data);   
    }

    public function privacy_policy()
    {
        $users = User::where('plan_code','premium')->get()->take(5);

        $data = [
            'title'     => 'Privacy Policy',
            'users'     => $users
        ];

        return view('local.site.privacy_policy',$data);
    }

}
