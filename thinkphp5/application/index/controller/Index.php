<?php
namespace app\index\controller;
use think\Controller;
use app\index\model\Menu_list;
use app\index\model\Online_shop;
<<<<<<< HEAD
use app\admin\model\Links_url;
=======
use think\Request;
>>>>>>> ff1b938aab2a6588aeb065eedc5f3909f80aecb9
class Index extends Controller
{
	protected $menu;
	protected $shop;
	public function _initialize()
	{
		$this->menu = new Menu_list();
		$this->shop = new Online_shop();
		$this->Links_url = new Links_url();
      $link = $this->Links_url->selink();
      $this->assign('link',$link);
	}
	public function index(Request $request)
	{
		
		$menu_list = $this->menu->select_menu();
		
		//查询商家的id,去除重复商家的id
		foreach ($menu_list as $key => $value) 
		{
			$arr[] = $value['shop_id'];
		}
		$shop_id = implode(',',array_unique($arr));//提取去重商家的id
		
		//查询入驻商家相关信息
		$shop_info = $this->shop->select_shop($shop_id);
		
		//分页
		$list = $this->menu->menu_limit();
		$page = $list->render();
			
		$this->assign('page',$page);
		$this->assign('list',$list);
		$this->assign('menu_list',$menu_list);
		$this->assign('shop_info',$shop_info);
		//dump(session('user_id'));
		return $this->fetch();
	}
	public function head()
	{
		return $this->fetch();
	}

}

