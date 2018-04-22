<?php
// 本文档自动生成，仅供测试运行
//require("./test.php");
class CityAction extends Action
{
    /**
    +----------------------------------------------------------
    * 默认操作
    +----------------------------------------------------------
    */
// 数据写入操作
    Public function _empty()
    {
        // 把所有城市癿操作都览枂刡city方法
        
        $cityName = ACTION_NAME;
        if($cityName == "index") $cityName=htmlspecialchars($_POST['cityName']);
        $this->city($cityName);
        
    }
    Public function fankui()
    {
      $Demo12 = new Model('jiting');
      $Demo12->text = htmlspecialchars($_POST['text']);
      $Demo12->securecode = Cookie::get('secureid');
      $Demo12->username = htmlspecialchars(Cookie::get('username'));
      $Demo12->url = urlencode(htmlspecialchars($_POST['url']));
      $Demo12->create();
      //var_dump($Demo12);
      //$Demo12->create();
      //$Demo23['text'] = htmlspecialchars($_POST['text']);
      //$Demo23['securecode'] = Cookie::get('secureid');
      //$Demo23['username'] = htmlspecialchars(Cookie::get('username'));
      //Demo23['url'] = urlencode(htmlspecialchars($_POST['url']));
      
      $result = $Demo12->add();
      
      //echo $result;
      if ($result)
			{//echo $result;
					$this->assign('informationtext', '提交成功哦！');// 模板发量赋值
          $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
          $this->assign('informationurl', 'Javascript:window.history.go(-1)');//模板变量赋值
          $this->display('Public:information');//如果模板为空
			}
			else
			{
					$this->assign('informationtext', '提交失败，不过还是谢谢你。请登录后再提交哦');// 模板发量赋值
          $this->assign('informationtitle', '太鼓太鼓提示');// 模板发量赋值
          $this->assign('informationurl', 'Javascript:window.history.go(-1)');//模板变量赋值
          $this->display('Public:information');//如果模板为空
			}
    }
    Public function city($name)
    {
        // 和$name 返个城市相关癿处理
        //确认没提交基厅id
      	if($_GET['ViewJiting']<>'') //如果提交了
      	{
      		$linshibianliang=htmlspecialchars($_GET['ViewJiting']);
      		//echo $linshibianliang;
      		$this->getjiting($linshibianliang);
      	}
      	else
      	{
	        //$py=new py_class(); 
	        //$name = iconv('GBK', 'UTF-8',strtolower($py->str2py($name)));//输出城市名
	        
	        $Demo = new Model('youxijiting');//创建查询对象
	        $condition['yxt_area'] = $name;  //地区名 魔都-上海 妖都-广州 古都-西安 帝都-北京
	        if($condition['yxt_area'] == "魔都") $condition['yxt_area'] = "上海";
	        if($condition['yxt_area'] == "妖都") $condition['yxt_area'] = "广州";
	        if($condition['yxt_area'] == "古都") $condition['yxt_area'] = "西安";
	        if($condition['yxt_area'] == "帝都") $condition['yxt_area'] = "北京";
	        $condition['deleted'] = 0;
	        $list = $Demo->where($condition)->select();//赋予条件 
	        //echo 'asdfasdfasdf';
	        //echo $name;
	        //$this->assign('CityName',$name);
	        if($list == NULL)
	        {
	        	if($name == NULL){
	        	$this->assign('informationtext','直接访问什么的可不好哟，年轻人'); // 模板发量赋值
	        	$this->assign('informationtitle','太鼓太鼓提示'); // 模板发量赋值
	        	$this->assign('informationurl','__APP__');//模板变量赋值
	          $this->display('Index:index'); //如果模板为空
	        	}
	        	else{
	        	$this->assign('informationtext','抱歉，暂时没有'.$name.'的信息哦。要不要帮我们加一下？'); // 模板发量赋值
	        	$this->assign('informationtitle','太鼓太鼓提示'); // 模板发量赋值
	        	$this->assign('informationurl','__APP__/New');//模板变量赋值
	          $this->display('Public:information'); //如果模板为空
	          }
	        }
	        else
	        {
	        	$this->assign('CityName',$name); // 模板发量赋值
	          $this->assign('list',$list); // 模板发量赋值
	          $this->display('index'); // 输出模板
	        }	
     	  }
    } 

    /**
    +----------------------------------------------------------
    * 探针模式
    +----------------------------------------------------------
    */
    Public function getjiting($id)
 		{
        // 和$name 返个城市相关癿处理
        //确认没提交基厅id
        //$py=new py_class(); 
        //$name = iconv('GBK', 'UTF-8',strtolower($py->str2py($name)));//输出城市名
        //echo '当前城市: '.$id;
        
        $Demo1 = new Model('youxijiting');//创建查询对象
        $Demo2 = new Model('youxijitai');//创建查询对象
        $Demo3 = new Model('youxijiting');//创建查询对象
        $condition1['id'] = $id;  //地区名
        $condition2['yxtid'] = $id;  //地区名
        $condition2['deleted'] = 0;
        $list1 = $Demo1->where($condition1)->select();//赋予条件 
     		$list2=$Demo2->where($condition2)->select();
        $list22 = $Demo3->getField('yxt_area','id = '.$condition1['id']);//赋予条件
        //$list2 = $Demo1->where($condition1)->select();
        //echo 'asdfasdfasdf';
          //print_r($list1);
          //echo $list1['yxt_name'];
        //$this->assign('CityName',$name);
				  $this->assign('CityName',$list22); // 模板发量赋值
          $this->assign('jitingmingzi',$list1); // 模板发量赋值
          $this->assign('jitai',$list2); // 模板发量赋值
          $this->display('room'); // 输出模板
        
    }
    

}

?>