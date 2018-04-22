<?php
class NewAction extends Action{
	/**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
	// 数据写入操作
	public function insert() {
		
		if ($_SESSION['verify'] == md5($_POST['verify']))
		{
			$youxijiting = new Model('youxijiting');// 实例化模型类
			$youxijiting->yxt_name = htmlspecialchars($_POST['yxt_name'], ENT_QUOTES);
			$youxijiting->yxt_address = htmlspecialchars($_POST['yxt_address'], ENT_QUOTES);
			$youxijiting->yxt_hyjg = htmlspecialchars($_POST['yxt_hyjg'], ENT_QUOTES);
			$youxijiting->yxt_csqk = htmlspecialchars($_POST['yxt_csqk'], ENT_QUOTES);
			$youxijiting->yxt_jtqk = htmlspecialchars($_POST['yxt_jtqk'], ENT_QUOTES);
			$youxijiting->yxt_area = htmlspecialchars($_POST['location'], ENT_QUOTES);
			$youxijiting->securecode = htmlspecialchars($_POST['securecode'], ENT_QUOTES);
			$youxijiting->username = htmlspecialchars($_POST['username'], ENT_QUOTES);
			$_POST['yxt_area'] = htmlspecialchars($_POST['yxt_area'], ENT_QUOTES);//$youxijiting->test = 'test';
			$youxijiting->Create();// 创建数据对象
			// 写入数据库
			
			if ($result = $youxijiting->add())
			{//echo $result;
				$this->assign('yxtid', htmlspecialchars($result, ENT_QUOTES));
				$this->assign('yxtname', htmlspecialchars($_POST['yxt_name'], ENT_QUOTES));//$Demo = new Model('Demo');//创建查询对象
				$condition['yxtid'] = $result;//地区名
				$list = $youxijiting->where($youxijiting)->select();//赋予条件 e
				//echo $list->yxt_area;
				//$Demo->closeConnect();
				//echo $_POST['yxt_address'];
				$this->display('step2');// 输出模板
			}
			else
			{
				$this->redirect('/Index/index', array(''), 5, '数据写入错误！返回首页中');
			}
			
			//$this->redirect('/Index/index', array('redirect'=>1), 3,'请稍等');
		}
		else
		{
			$this->assign('informationtext', '验证码提交不正确。四个数字YOOO！');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/New/'.$_POST['location']);//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}
	
	public function insertnew() {
		if ($_SESSION['verify'] == md5($_POST['verify']))
		{
			$youxijitai = new Model('youxijitai');// 实例化模型类
			$youxijitai->yxtid = htmlspecialchars($_POST['yxtid'], ENT_QUOTES);
			$youxijitai->jt_dm = htmlspecialchars($_POST['jt_dm'], ENT_QUOTES);
			$youxijitai->jt_jg = htmlspecialchars($_POST['jt_jg'], ENT_QUOTES);
			$youxijitai->jt_gk = htmlspecialchars($_POST['jt_gk'], ENT_QUOTES);
			$youxijitai->Create();// 创建数据对象
			// 写入数据库
			
			if ($result = $youxijitai->add())
			{
				$this->assign('yxtid', htmlspecialchars($_POST['yxtid'], ENT_QUOTES));
				$condition['yxtid'] = htmlspecialchars($_POST['yxtid'], ENT_QUOTES);//地区名
				$list = $youxijitai->where($condition)->select();//赋予条件
				//$Demo->closeConnect();
				$this->assign('list', $list);// 模板发量赋值
				$this->display('step2');// 输出模板
			}
			else
			{
				$this->redirect('/Index/index', array(''), 5, '数据写入错误！返回首页中');
			}
			
			//$this->redirect('/Index/index', array('redirect'=>1), 3,'请稍等');
		}
		else
		{
			$this->assign('informationtext', '验证码提交不正确。四个数字YOOO！');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/New/'.$_POST['location']);//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}
	
	
	public function index() {//$py=new py_class();
		$name = htmlspecialchars($_POST['location']);
    $haslogin = checklogin();
    if($haslogin)
    {
    $username123 = md5(cookie('username'));
		$secureid123 = cookie::get('secureid');
		//$secureusername = cookie::get('secureusrname'); 
		$secureusername_chk123 = securecode($secureid, $username);
		$this->assign('securecode', $secureusername_chk123 );//模板变量赋值
		$this->assign('username', $username123);//模板变量赋值
		$this->display('city');//如果模板为空
    }
    else
    {
		if ($name == NULL)
		{
			$name = ACTION_NAME;
		}
		
		//$name = iconv('GBK', 'UTF-8',strtolower($py->str2py($name)));//输出城市名
		$Demo = new Model('Demo');// 实例化模型类
		$list = $Demo->select();// 查诟数据
		
		if ($name == 'index')
		{
			$redirect_uri = 'http://taiko.52yinyou.net/New/returnlogin/';
			$authorize_uri = 'https://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=zQcuDz31BKDeA6GHLjgOeYWl&redirect_uri=' . urlencode($redirect_uri);
			$this->assign('loginurl', $authorize_uri);//if($name == "index") $cityName=htmlspecialchars($_POST['location']);
			$this->display('New:index');
		}
		else
		{
			$this->assign('cityname', htmlspecialchars($name, ENT_QUOTES));
			$this->display('New:index');// 输出模板
		}
		}
	}
	
	public function Old() {
		$this->display('choosecity');
	}
	
	public function City($securecode, $username) {
		$taiguus_cityname=htmlspecialchars($_POST['location'], ENT_QUOTES);
		$securecode_32=htmlspecialchars($_POST['securecode'], ENT_QUOTES);
		$username_32=htmlspecialchars($_POST['username'], ENT_QUOTES);
		//WW$this->assign('cityname', htmlspecialchars($name, ENT_QUOTES));
		$this->assign('hash1', htmlspecialchars($securecode_32, ENT_QUOTES));
		$this->assign('hash2', htmlspecialchars($username_32, ENT_QUOTES));
		$this->assign('location', htmlspecialchars($taiguus_cityname, ENT_QUOTES));
		$this->display('newgd');
	}
	
	/**
    +----------------------------------------------------------
    * 探针模式
    +----------------------------------------------------------
    */
	public function verify(){// 导入Image类库
		import('ORG.Util.Image');
		Image::buildImageVerify();
	}
	


	function returnlogin() {
		$redirect_uri = 'http://taiko.52yinyou.net/New/returnlogin/';
		$authorization_code = 'aa';
		$authorization_code = $_GET['code'];
		//$authorization_code = ACTION_NAME;
		//echo $_SERVER['self'];
    //print_r($_GET);
		//foreach   ($_GET as $key=>$value)  
      //{
       //echo   "Key: $key; Value: $value <br/>\n ";
      //}
		//echo $authorization_code;
		$token_uri = 'https://openapi.baidu.com/oauth/2.0/token?grant_type=authorization_code&code='. $authorization_code . '&client_id=zQcuDz31BKDeA6GHLjgOeYWl&client_secret=qSNXvBT5A7ml0GnUb21v8nEFdj0RszBh&redirect_uri='. urlencode($redirect_uri);
		$retval = request($token_uri, NULL);
		//echo $token_uri;
		if ($retval != NULL)
		{
			$Arr = json_decode($retval);
		}
		else
		{
			$this->assign('informationtext', '服务器过载，与百度通信错误！请刷新重试');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', 'Javascript:window.history.go(-1)');//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
		
		$useruri = 'https://openapi.baidu.com/rest/2.0/passport/users/getLoggedInUser?access_token='.$Arr->access_token.'&format=json';
		$retvaluser = request($useruri, NULL);
		//echo $useruri;
		//echo $retvaluser;
		
		if ($retvaluser != NULL)
		{
			$Arr2 = json_decode($retvaluser);
		}
		else
		{
			$this->assign('informationtext', '用户信息获取失败，可能是服务器与百度通信错误！请刷新重试');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', 'Javascript:window.history.go(-1)');//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
		
		//此时用户名$Arr2->uname。uid是$Arr2->uid。
		$newusername = $Arr2->uname;
		//echo $newusername;
		if ($newusername != NULL)
		{
			$newuid = $Arr2->uid;
			//echo $newuid ;
			cookie('username', $newusername, time()+3600*24);
			$secureid = securecode($newusername, $newuid);
			//echo $secureid;
			cookie('secureid', $secureid, time()+3600*24);
			cookie('uid', $newuid, time()+3600*24);
			$secureusrname = securecode($secureid, $newusername);
			cookie('secureusrname', $secureusrname, time()+3600*24);//登录成功
			$secureusername_md5 = securecode($secureid, $username);
			$username_md5 = md5($newusername);
			//<input type="hidden" name="securecode" value="{$securecode}" />
			//<input type="hidden" name="username" value="{$username}" />
			$this->assign('securecode', $secureusername_md5 );//模板变量赋值
			$this->assign('username', $username_md5);//模板变量赋值
			$this->display('city');//如果模板为空
			//echo $secureid,$secureusrname;
		}
		else
		{
			$this->assign('informationtext', '数据错误，请不要返回刷新本页！请重新点击登录按钮');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/Edit');//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}

}
	function securecode($username, $uid) {
		$restore = md5(md5('*_(taiko)_*|'.$username.'|Taiko.tk|'.$uid.'|taigu.us|taiko.52yinyou.net'));
		return $restore;
	}
		function request($url, $posts)
{
	if (is_array($posts) && !empty($posts))
	{
		foreach ($posts as $key=>$value)
		{
			$post[] = $key.'='.urlencode($value);
		}
		
		$posts = implode('&', $post);
	}
	
	$curl = curl_init();
	$options = array(CURLOPT_URL=>$url, CURLOPT_CONNECTTIMEOUT => 20, CURLOPT_TIMEOUT => 20, CURLOPT_RETURNTRANSFER => true, CURLOPT_POST => 1, CURLOPT_POSTFIELDS=>$posts,//CURLOPT_USERAGENT=>'Mozilla/5.0 (Windows NT 5.1; rv:5.0) Gecko/20100101 Firefox/5.0',
	//CURLOPT_SSL_VERIFYPEER => FALSE,
	//CURLOPT_FOLLOWLOCATION => 1,
	//CURLOPT_SSL_VERIFYHOST => false
	);
	curl_setopt_array($curl, $options);//echo $url;
	// echo '<br />';
	$retval = curl_exec($curl);//echo '<br />';
	//echo $retval;
	return $retval;
}
function checklogin()
{
	$is_username = cookie('username');
	
	if($is_username != NULL)//如果设置了
	{
		$secureid = cookie::get('secureid');
		$username = cookie::get('username');
		$uid = cookie::get('uid');//echo $secureid .'    '.$username.'     '.$uid ;
		
		if ($secureid != securecode($username, $uid))
		{//如果说你的验证是不通过的
			return false;
		}
		else
		{//验证过了直接Pass掉
			return true;
		}
	}
	else
	{//或者说根本就木有
		return false;
	}
}

?>