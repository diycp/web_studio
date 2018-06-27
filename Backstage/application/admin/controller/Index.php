<?php
namespace app\admin\controller;
use think\Controller;
use think\Session;
use think\Request;
use think\Db;
class Index extends Controller
{
    public function __construct(){
        parent::__construct();
        $user = Session::get('user');
        //校验是否登录
        if(!$user){
            $this->error('请先登录！',url('Login/login'));
        }
    }

    /**
     * 首页
     * @Author   Jenick
     * @DateTime 2018-06-26T16:48:52+0800
     */
    public function index()
    {
        $user = Session::get('user');
        return $this->fetch('',[
            'name'  =>  $user['name']
        ]);
    }

    /**
     * 欢迎页
     * @Author   Jenick
     * @DateTime 2018-06-26T16:49:05+0800
     */
    public function welcome()
    {
        $data=Db::name('notice')->limit(0,4)->select();
        $member=Db::name('member')->count();
        $content=Db::name('content')->count();
        $this->assign(array('data'=>$data,'member'=>$member,'content'=>$content));
        return $this->fetch();
        
    }

    /**
     * 修改密码
     * @Author   Jenick
     * @DateTime 2018-06-26T17:15:50+0800
     */
    public function editPassword(Request $request)
    {
        $user = Session::get('user');
        if($request->isPost()){
            $data = $request->post();
            if(md5($data['oldPassword']) != $user['password']){
                return getJson(1,'原密码不正确！');
            }
            if($data['password'] != $data['confirmPassword']){
                return getJson(2,'密码不一致哦');
            }
            $res = model('admin')
                    ->where('id','=',$user['id'])
                    ->update(['password'=>md5($data['password'])]);
            if($res){
                session(null);
                return getJson(0,'更新成功');
            }
            return getJson(3,'更新失败');
        }
        return $this->fetch('',[
            'username'  =>  $user['username']
        ]);
    }

     /**
     * 后台导航
     * @Author   Jenick
     * @DateTime 2018-05-31T22:11:58+0800
     * @return   JSON
     */
    public function nav() {
        $user = Session::get('user');
        if($user['pid'] == 0){
            $data = [
                'data' =>  [
                   '0'  =>  [
                        "text"  =>  "管理员管理",
                        "icon"  =>  "&#xe612;",
                        "subset"=>  [
                            [
                                "text"  =>  "管理员列表",
                                "icon"  =>  "&#xe612;",
                                "href"  =>  url('Admin/index')
                            ],
                        ]
                   ],
                   '1'  =>  [
                            "text"  =>  "栏目管理",
                            "icon"  =>  "&#xe62a;",
                            "subset"=>  [
                                [
                                    "text"  =>  "栏目列表",
                                    "icon"  =>  "&#xe62a;",
                                    "href"  =>  url('Category/index')
                                ],
                            ]
                    ],
                    '2'  =>  [
                        "text"=>"文章管理",
                        "icon"=> "&#xe705;",
                        "subset"=>[
                            [
                            "text"  =>  "文章列表",
                            "icon"  =>  "&#xe705;",
                            "href"  =>  url('Content/index')
                            ],
                            [
                                "text"  =>  "回收站",
                                "icon"  =>  "&#xe640;",
                                "href"  =>  url('Admin/index')
                            ]
                        ]
                    ],
                    '3'  =>  [
                        "text"  =>  "成员信息管理",
                        "icon"  =>  "&#xe613;",
                        "subset"    =>  [
                            [
                                "text"  =>  "成员列表",
                                "icon"  => "&#xe613;",
                                "href"  =>  url('Member/index')
                            ],
                            [
                                "text"  =>  "成员作品",
                                "icon"  => "&#xe613;",
                                "href"  =>  url('Member/works')
                            ]
                        ]
                    ],
                    '4'  =>  [
                        "text"  => "幻灯片管理",
                        "icon"  => "&#xe64a;",
                        "href"  => url('Notice/index')
                    ],
                     '5'  =>  [
                        "text"  => "系统公告",
                        "icon"  => "&#xe645;",
                        "href"  => url('Slide/index')
                    ],
                    '6'  =>  [
                        "text"  => "系统设置",
                        "icon"  => "&#xe614;",
                        "href"  => url('Setup/index')
                    ]
                ]
            ];
        } else {
            $data = [
                'data' =>  [
                    '0'  =>  [
                        "text"  =>  "文章管理",
                        "icon"  =>  "&#xe705;",
                        "href"  =>  "demo/tab-card.html"
                    ],
                    '1'  =>  [
                        "text"  =>  "成员信息管理",
                        "icon"  =>  "&#xe613;",
                        "href"  =>  "demo/tab-card.html"
                    ]

                ]
            ];
        }
    	return json($data);
    }
    
}
