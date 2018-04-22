<?php
// 本文档自动生成，仅供测试运行
//require("./test.php");
class EditAction extends Action{
	/**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
	// 数据写入操作
	public function submiteditjt() {
	$test=checklogin();	
	$secureid = Cookie::get('secureid');
	//echo md5($secureid).'<br>'.$_POST['verify'];
	$test2= md5($secureid)==htmlspecialchars($_POST['verify'], ENT_QUOTES);//摆设
	if ($test and $test2)
		{
		$Demo = new Model('youxijiting');// 实例化模型类
		$condition['id'] = htmlspecialchars($_POST['yxt_id'], ENT_QUOTES);//地区名
		$list = $Demo->getField('username','id = '.$condition['id']);//赋予条件
		//->getField('username')
		//echo $list;
		$username = Cookie::get('username');
		
		$secureusername = Cookie::get('secureusrname'); 
		$secureusername_chk = securecode($secureid, $username);
		//$condition['username'] = md5($username);//以用户名为md5值查询
		if(($list ==  md5($username)) and ($secureusername == $secureusername_chk))//验证是不是此用户
		{ //处理数据
      $Demo3 = new Model('youxijiting');// 实例化模型类
      //$Demo2 = new Model('youxijiting');// 实例化模型类
      $Demo2['id'] = $condition['id'];
      $Demo2['yxt_name'] = htmlspecialchars($_POST['yxt_name'], ENT_QUOTES);
      $Demo2['yxt_address'] = htmlspecialchars($_POST['yxt_address'], ENT_QUOTES);
      $Demo2['yxt_hyjg'] = htmlspecialchars($_POST['yxt_hyjg'], ENT_QUOTES);
      $Demo2['yxt_csqk'] = htmlspecialchars($_POST['yxt_csqk'], ENT_QUOTES);
      $Demo2['yxt_jtqk'] = htmlspecialchars($_POST['yxt_jtqk'], ENT_QUOTES);
      $Demo2['deleted'] = htmlspecialchars($_GET['delete'], ENT_QUOTES); //检查是否删除
      //$Demo2['yxt_area'] = htmlspecialchars($_POST['location'], ENT_QUOTES);
      //$Demo2->Create();// 创建数据对象 
      // 写入数据库
      if($Demo2['deleted'] == 'yes') {$Demo2['deleted'] = '1';} else {$Demo2['deleted'] = '0';}
      $result = $Demo3->save($Demo2);
      //echo $result;
      if ($result)
      {//写入成功了
        $this->assign('informationtext', '修改成功！');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
      }
      else
      {
        $this->assign('informationtext', '数据写入失败！如果操作正常而多次出现本错误可能是协作者锁定了本数据！');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
      }
		}
    else{ //不是用户
        $this->assign('informationtext', '权限失败，请使用录入人帐号请登录后再试！');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
    }
		}
		//$this->redirect('/Index/index', array('redirect'=>1), 3,'请稍等');
		else
		{
			$this->assign('informationtext', '用户鉴权失败。请重新登陆后再试。');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/New/'.$_POST['location']);//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}
	
		public function delete() {
	$test=checklogin();	
	//echo $test;
	$secureid = Cookie::get('secureid');
	//echo md5($secureid).'<br>'.$_POST['verify'];
	$test2= 1;
	if ($test and $test2)
		{
		$Demo = new Model('youxijiting');// 实例化模型类
		$condasdfasdf = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
		$condasdfasdf;
		$list = $Demo->getField('username','id = '.$condasdfasdf);//赋予条件
		//->getField('username')
		//echo $list;
		$username = Cookie::get('username');
		
		$secureusername = Cookie::get('secureusrname'); 
		$secureusername_chk = securecode($secureid, $username);
		//$condition['username'] = md5($username);//以用户名为md5值查询
		if(($list ==  md5($username)) and ($secureusername == $secureusername_chk))//验证是不是此用户
		{ //处理数据
      $Demo3 = new Model('youxijiting');// 实例化模型类
      //$Demo2 = new Model('youxijiting');// 实例化模型类
      $Demo2['id'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);
      $Demo2['deleted'] = '1'; //检查是否删除
      //$Demo2['yxt_area'] = htmlspecialchars($_POST['location'], ENT_QUOTES);
      //$Demo2->Create();// 创建数据对象 
      // 写入数据库

      $result = $Demo3->save($Demo2);
      //echo $result;
      if ($result)
      {//写入成功了
        $this->assign('informationtext', '已经删除。');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
      }
      else
      {
        $this->assign('informationtext', '删除失败。抱歉。');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
      }
		}
    else{ //不是用户
        $this->assign('informationtext', '权限失败，请使用录入人帐号请登录后再试！');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
    }
		}
		//$this->redirect('/Index/index', array('redirect'=>1), 3,'请稍等');
		else
		{
			$this->assign('informationtext', '用户鉴权失败。请重新登陆后再试。');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/New/'.$_POST['location']);//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}
	
	public function editjt() {//确认用户是否登录
		$test=checklogin();	
		$Demo = new Model('youxijiting');// 实例化模型类
		$condition['id'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
		$list = $Demo->getField('username','id = '.$condition['id']);//赋予条件
		$username = Cookie::get('username');
		$secureid = Cookie::get('secureid');
		$secureusername = Cookie::get('secureusrname'); 
		$secureusername_chk = securecode($secureid, $username);
		//$condition['username'] = md5($username);//以用户名为md5值查询
		$test2 = ($list ==  md5($username)) and ($secureusername == $secureusername_chk);//验证是不是此用户
		if (($test) and ($test2))
		{
			$showjiting = new Model('youxijiting');
			$condition['id'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
			$condition['deleted'] = 0;//是否删了？
			$list = $showjiting->where($condition)->select();//赋予条件
			//echo $list;
			//$this->assign('yxt_name',$yxt_name); // 模板发量赋值
			$this->assign('list', $list);// 模板发量赋值
			//$this->assign('yxt_address',$yxt_address); // 模板发量赋值
			//$this->assign('yxt_hyjg',$yxt_hyjg); // 模板发量赋值
			//$this->assign('yxt_csqk',$yxt_csqk); // 模板发量赋值
			//$this->assign('yxt_jtqk',$yxt_jtqk); // 模板发量赋值
			$username = Cookie::get('username');
			$this->assign('CityName', $username.'添加的机厅');// 模板发量赋值
			$this->assign('verify', md5($secureid));// 模板发量赋值
			$this->display('editjt');// 输出模板
		}
		else
		{
			$this->assign('informationtext', '鉴权失败。请使用该机厅添加者帐号登录！');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/Edit/');//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}
	
		public function viewgd() {//确认用户是否登录
		$test=checklogin();	
		$Demo = new Model('youxijiting');// 实例化模型类
		$condition['id'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
		$condition['deleted'] = 0;//是否删了？
		$list = $Demo->getField('username','id = '.$condition['id']);//赋予条件
		$username = Cookie::get('username');
		$secureid = Cookie::get('secureid');
		$secureusername = Cookie::get('secureusrname'); 
		$secureusername_chk = securecode($secureid, $username);
		//$condition['username'] = md5($username);//以用户名为md5值查询
		$test2 = ($list ==  md5($username)) and ($secureusername == $secureusername_chk);//验证是不是此用户
		if (($test) and ($test2))
		{
			$showgudian = new Model('youxijitai');
			$condition3['yxtid'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
			$condition3['deleted'] = 0;//地区名
			$list2 = $showgudian->where($condition3)->select();//赋予条件
			//echo $list;
			//$this->assign('yxt_name',$yxt_name); // 模板发量赋值
			$this->assign('list', $list2);// 模板发量赋值
			//$this->assign('yxt_address',$yxt_address); // 模板发量赋值
			//$this->assign('yxt_hyjg',$yxt_hyjg); // 模板发量赋值
			//$this->assign('yxt_csqk',$yxt_csqk); // 模板发量赋值
			//$this->assign('yxt_jtqk',$yxt_jtqk); // 模板发量赋值
			$username = Cookie::get('username');
			$this->assign('CityName', $username.'添加的机厅');// 模板发量赋值
			$this->assign('yxtid', $condition3['yxtid']);// 模板发量赋值
			$this->display('gudian');// 输出模板
		}
		else
		{
			$this->assign('informationtext', '鉴权失败。请使用该机厅添加者帐号登录！');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/Edit/');//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}
	
	public function submiteditac() {
	$test=checklogin();	
	$secureid = Cookie::get('secureid');
	$test2= 1;//摆设
	if ($test and $test2)
		{
		//Demo = new Model('youxijitai');// 实例化模型类
		//$condition['id'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
		//$list = $Demo->getField('username','yxtid = '.$condition['id']);//赋予条件
		//->getField('username')
		//echo $list;
		$username = Cookie::get('username');
		$ididid = htmlspecialchars($_POST['id'], ENT_QUOTES);
		$list = checkyyz($ididid);
		//echo md5($username).'<br>'.$username.'<br>'.$list;
		$secureusername = Cookie::get('secureusrname'); 
		$secureusername_chk = securecode($secureid, $username);
		//$condition['username'] = md5($username);//以用户名为md5值查询
		if(($list ==  md5($username)) and ($secureusername == $secureusername_chk))//验证是不是此用户
		{ //处理数据
      $Demo4 = new Model('youxijitai');// 实例化模型类
      //$Demo2 = new Array('youxijitai');// 实例化模型类
      $Demo3['id'] =  (int)htmlspecialchars($_POST['id'], ENT_QUOTES);
      //$Demo4->find($Demo5['id']);
      
      $Demo5['yxtid'] = htmlspecialchars($_POST['yxtid'], ENT_QUOTES);
      $Demo5['jt_dm'] = htmlspecialchars($_POST['jt_dm'], ENT_QUOTES);
      $Demo5['jt_jg'] = htmlspecialchars($_POST['jt_jg'], ENT_QUOTES);
      $Demo5['jt_gk'] = htmlspecialchars($_POST['jt_gk'], ENT_QUOTES);
      $Demo5['id'] = htmlspecialchars($_POST['id'], ENT_QUOTES);
      $Demo5['deleted'] = htmlspecialchars($_POST['deleted'], ENT_QUOTES);
      //$Demo2->Create();// 创建数据对象
      //echo $Demo5['deleted'];
      if($Demo5['deleted'] == 'no') {$Demo5['deleted'] = '1';} else {$Demo5['deleted'] = '0';}
      //echo $Demo5['deleted'];
      $result = $Demo4->where($Demo3)->save($Demo5);
      //$this->error($Form->getError());
      //echo $Demo3->getLastSql();
      //echo $result;
      if ($result !== false)
      {//写入成功了
        $this->assign('informationtext', '修改成功！');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
      }
      else
      {
        $this->assign('informationtext', '数据写入失败！如果操作正常而多次出现本错误可能是协作者锁定了本数据！');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
      }
		}
    else{ //不是用户
        $this->assign('informationtext', '权限失败，请使用录入人帐号请登录后再试！');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
    }
		}
		//$this->redirect('/Index/index', array('redirect'=>1), 3,'请稍等');
		else
		{
			$this->assign('informationtext', '暂未登录。请登录后再试。');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/Edit'.$_POST['location']);//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}
		public function editac() {//确认用户是否登录
		$test=checklogin();	
		$Demo = new Model('youxijiting');// 实例化模型类
		$condition['id'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
		$list = $Demo->getField('username','id = '.$condition['id']);//赋予条件
		$username = Cookie::get('username');
		$secureid = Cookie::get('secureid');
		$secureusername = Cookie::get('secureusrname'); 
		$secureusername_chk = securecode($secureid, $username);
		//$condition['username'] = md5($username);//以用户名为md5值查询
		$test2 = (1 ==  1) and ($secureusername == $secureusername_chk);//验证是不是此用户
		if (($test) and ($test2))
		{
			$showjitai = new Model('youxijitai');
			$condition2['id'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
			$condition2['deleted'] = 0;//地区名
			$list = $showjitai->where($condition2)->select();//赋予条件
			//echo $condition2['yxtid'];
			//var_dump($list);
			//$this->assign('yxt_name',$yxt_name); // 模板发量赋值
			$this->assign('list', $list);// 模板发量赋值
			//$this->assign('yxt_address',$yxt_address); // 模板发量赋值
			//$this->assign('yxt_hyjg',$yxt_hyjg); // 模板发量赋值
			//$this->assign('yxt_csqk',$yxt_csqk); // 模板发量赋值
			//$this->assign('yxt_jtqk',$yxt_jtqk); // 模板发量赋值
			$username = Cookie::get('username');
			$this->assign('CityName', $username.'添加的机厅');// 模板发量赋值
			//$this->assign('verify', md5($secureid));// 模板发量赋值
			$this->display('editac');// 输出模板
		}
		else
		{
			$this->assign('informationtext', '鉴权失败。请使用该机厅添加者帐号登录！');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/Edit/');//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}

	public function insertnewac() {
	$test=checklogin();	
	$secureid = Cookie::get('secureid');
	$test2= 1;//摆设
	if ($test and $test2)
		{
		//Demo = new Model('youxijitai');// 实例化模型类
		//$condition['id'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
		//$list = $Demo->getField('username','yxtid = '.$condition['id']);//赋予条件
		//->getField('username')
		//echo $list;
		$username = Cookie::get('username');
		$ididid = htmlspecialchars($_POST['yxtid'], ENT_QUOTES);
		$Demo233 = new Model('youxijiting');// 实例化模型类
		
		$list = $Demo233->getField('username','id = '.$ididid);//赋予条件
		//echo md5($username).'<br>'.$username.'<br>'.$list;
		$secureusername = Cookie::get('secureusrname'); 
		$secureusername_chk = securecode($secureid, $username);
		//$condition['username'] = md5($username);//以用户名为md5值查询
		if(($list ==  md5($username)) and ($secureusername == $secureusername_chk))//验证是不是此用户
		{ //处理数据
      	$youxijitai = new Model('youxijitai'); // 实例化模型类
        $youxijitai->yxtid = htmlspecialchars($_POST['yxtid'], ENT_QUOTES);
        $youxijitai->jt_dm = htmlspecialchars($_POST['jt_dm'], ENT_QUOTES);
        $youxijitai->jt_jg = htmlspecialchars($_POST['jt_jg'], ENT_QUOTES);
        $youxijitai->jt_gk = htmlspecialchars($_POST['jt_gk'], ENT_QUOTES);
        
        $youxijitai->Create(); // 创建数据对象
        // 写入数据库
        if($result = $youxijitai->add()){
        $this->assign('yxtid',htmlspecialchars($_POST['yxtid'], ENT_QUOTES));
        $condition['yxtid'] = htmlspecialchars($_POST['yxtid'], ENT_QUOTES);  //地区名
        $list = $youxijitai->where($condition)->select();//赋予条件 
        //$Demo->closeConnect();
        $this->assign('list',$list); // 模板发量赋值
        $this->assign('informationtext', '添加成功哦。');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit/viewgd/?jitingid='.htmlspecialchars($_POST['yxtid'], ENT_QUOTES));//模板变量赋值
        $this->display('Public:information');//如果模板为空
   			 } else {
        $this->redirect('/Index/index', array(''), 5,'数据写入错误！返回首页中'); 
    		}
        //$this->redirect('/Index/index', array('redirect'=>1), 3,'请稍等'); 
		}
    else{ //不是用户
        $this->assign('informationtext', '权限失败，请使用录入人帐号请登录后再试！');// 模板发量赋值
        $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
        $this->assign('informationurl', '/Edit');//模板变量赋值
        $this->display('Public:information');//如果模板为空
    }
		}
		//$this->redirect('/Index/index', array('redirect'=>1), 3,'请稍等');
		else
		{
			$this->assign('informationtext', '暂未登录。请登录后再试。');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/Edit'.$_POST['location']);//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}
		public function addgd() {//确认用户是否登录
		$test=checklogin();	
		$Demo = new Model('youxijiting');// 实例化模型类
		$condition['id'] = htmlspecialchars($_GET['jitingid'], ENT_QUOTES);//地区名
		$list = $Demo->getField('username','id = '.$condition['id']);//赋予条件
		$username = Cookie::get('username');
		$secureid = Cookie::get('secureid');
		$secureusername = Cookie::get('secureusrname'); 
		$secureusername_chk = securecode($secureid, $username);
		//$condition['username'] = md5($username);//以用户名为md5值查询
		$test2 = (1 ==  1) and ($secureusername == $secureusername_chk);//验证是不是此用户
		if (($test) and ($test2))
		{
			//$jitingid = 
			$this->assign('yxtid', $condition['id']);// 模板发量赋值
			//$this->assign('yxt_address',$yxt_address); // 模板发量赋值
			//$this->assign('yxt_hyjg',$yxt_hyjg); // 模板发量赋值
			//$this->assign('yxt_csqk',$yxt_csqk); // 模板发量赋值
			//$this->assign('yxt_jtqk',$yxt_jtqk); // 模板发量赋值
			$username = Cookie::get('username');
			$this->assign('CityName', $username.'添加的机厅');// 模板发量赋值
			//$this->assign('verify', md5($secureid));// 模板发量赋值
			$this->display('addgd');// 输出模板
		}
		else
		{
			$this->assign('informationtext', '鉴权失败。请使用该机厅添加者帐号登录！');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/Edit/');//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
	}
	// 数据查诟操作
	Public function _empty() {// 把所有城市癿操作都览枂刡city方法
		$name = ACTION_NAME;
		
		if ($name == 'index')
		{
			$cityName=htmlspecialchars($_POST['location']);
		}
		
		$this->index();
	}
	
	public function index() {
		$this->checklogin(1);
	}
	
	public function returnlogin() {
		$redirect_uri = 'http://taiko.52yinyou.net/Edit/returnlogin';
		$authorization_code = $_REQUEST['code'];//echo $authorization_code;
		$token_uri = 'https://openapi.baidu.com/oauth/2.0/token?grant_type=authorization_code&code='. htmlspecialchars($_REQUEST['code'], ENT_QUOTES). '&client_id=zQcuDz31BKDeA6GHLjgOeYWl&client_secret=qSNXvBT5A7ml0GnUb21v8nEFdj0RszBh&redirect_uri='. urlencode($redirect_uri);
		$retval = request($token_uri, NULL);
		
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
		$retvaluser = request($useruri, NULL);//echo $useruri;
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
		
		if ($newusername != NULL)
		{
			$newuid = $Arr2->uid;
			Cookie::set('username', $newusername, time()+3600*24);
			$secureid = securecode($newusername, $newuid);
			Cookie::set('secureid', $secureid, time()+3600*24);
			Cookie::set('uid', $newuid, time()+3600*24);
			$secureusrname = securecode($secureid, $newusername);
      Cookie::set('secureusrname', $secureusrname, time()+3600*24);
			$this->checklogin(1);
		}
		else
		{
			$this->assign('informationtext', '数据错误，请不要返回刷新本页！请重新点击登录按钮');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/Edit');//模板变量赋值
			$this->display('Public:information');//如果模板为空
		}
		
		//this->redirect('/Edit/index', array(''), 1,'数据写入错误！返回首页中');
		//if(Cookie::get('secureid') != securecode(Cookie::get('username'),Cookie::get('uid'))){  //如果说你的验证是不通过的
		//echo $Arr2->uname.'<br />'.$Arr2->uid;
	}
		public function logout()
		{// 导入Image类库
		Cookie::delete('username');
		Cookie::delete('secureid');
		Cookie::delete('uid');
		
			$this->assign('informationtext', '退出成功！');// 模板发量赋值
			$this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
			$this->assign('informationurl', '/Edit');//模板变量赋值
			$this->display('Public:information');//如果模板为空
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
	
	public function checklogin($integer){//$py=new py_class();
		//die("Cannot Run!");
		//$name = htmlspecialchars($_POST['location']);
		//if($name == NULL) $name = ACTION_NAME;
		//$name = iconv('GBK', 'UTF-8',strtolower($py->str2py($name)));//输出城市名
		///$Demo = new Model('Demo'); // 实例化模型类
		//$list = $Demo->select(); // 查诟数据
		//if($name == 'index')
		//{
		//在开始之前先检查Cookies
		//echo $is_username ;
		//////////FORTEST
		//$secureid = Cookie::get('secureid');
		//$username = Cookie::get('secureusrname');
		//$uid = Cookie::get('uid');
		//echo $secureid .'    '.$username.'     '.$uid ;
		/////////////FORTEST
		$is_username = Cookie::is_set('username');
		//Cookie::delete('username');
		if($is_username != NULL)//如果设置了
		{
			$secureid = Cookie::get('secureid');
			$username = Cookie::get('username');
			//echo $username;
      $secureusrname =  Cookie::get('secureusrname');
			$uid = Cookie::get('uid');//echo $secureid .'    '.$username.'     '.$uid ;
			//$secureusrname = securecode($secureid, $newusername);
			//echo $secureusrname;
			//$username = Cookie::delete('username');
			if ($secureid != securecode($username, $uid))
			{//如果说你的验证是不通过的
				$redirect_uri = 'http://taiko.52yinyou.net/Edit/returnlogin';
				$authorize_uri = 'https://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=zQcuDz31BKDeA6GHLjgOeYWl&redirect_uri=' . urlencode($redirect_uri);
				$this->assign('loginurl', $authorize_uri);
				$this->display('index');
			}
			else
			{//验证过了直接Pass掉
				$getlist = new Model('youxijiting');//创建查询对象
				$condition['username'] = md5($username);//以用户名为md5值查询
				$condition['deleted'] = 0;//以用户名为md5值查询
				$list = $getlist->where($condition)->select();//赋予条件
				$this->assign('CityName', $username.'添加的机厅');// 模板发量赋值
				$this->assign('list', $list);// 模板发量赋值
				$this->display('mycity');// 输出模板
			}
		}
		else
		{//或者说根本就木有
			$redirect_uri = 'http://taiko.52yinyou.net/Edit/returnlogin';
			$authorize_uri = 'https://openapi.baidu.com/oauth/2.0/authorize?response_type=code&client_id=zQcuDz31BKDeA6GHLjgOeYWl&redirect_uri=' . urlencode($redirect_uri);
			$this->assign('loginurl', $authorize_uri);
			$this->display('index');//}else{
			//$this->assign('cityname',htmlspecialchars($name, ENT_QUOTES));
			//$this->display('New:index'); // 输出模板
		}
	}
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

function securecode($username, $uid)
{
	$restore = md5(md5('*_(taiko)_*|'.$username.'|Taiko.tk|'.$uid.'|taigu.us|taiko.52yinyou.net'));
	return $restore;
}

function checklogin()
{
	$is_username = Cookie::is_set('username');
	
	if($is_username != NULL)//如果设置了
	{
		$secureid = Cookie::get('secureid');
		$username = Cookie::get('username');
		$uid = Cookie::get('uid');//echo $secureid .'    '.$username.'     '.$uid ;
		
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
function checkyyz($id)  //检查该鼓是否属于该人录入的机厅
{
    $Demo = new Model('youxijitai');// 实例化模型类
    $Demo2 = new Model('youxijiting');// 实例化模型类
		$id32323 = $id;//机台id
		//echo $id32323;
		$list = $Demo->getField('yxtid','id = '.$id32323);//获得机厅id
		//echo $list;
		$list2 = $Demo2->getField('username','id = '.$list);//获得用户id
		//echo $list2;
		return $list2;
}
?>