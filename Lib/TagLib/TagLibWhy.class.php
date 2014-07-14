<?php
//import('TagLib');
class TagLibWhy extends TagLib {
   //标签定义
   protected $tags=array(
       'article'=>array('attr'=>'aid','level'=>1),
       'slide'=>array('attr'=>'limit','level'=>1),
       'user'=>array('level'=>1),
   );

   public function _article($attr,$content)
   {
        $tag=$this->parseXmlAttr($attr);
        $aid = $tag['aid'];
        $map = '\'aid='.$aid.'\'';
        $sql = 'M(\'content\')->where('.$map.')->find()';
        $parsestr = '<?php $_result='.$sql.';';
        $parsestr .= 'extract($_result);';
        $parsestr .= '$url=U(\'SPage/view\',array(\'cat\'=>$cid,\'cont\'=>$aid));';
        $parsestr .= '$content = RecoverRequest($content); ?>';
        $parsestr .= $content;//解析标签中的内容
        return  $parsestr; 
   }

   public function _slide($attr,$content)
   {
        $tag=$this->parseXmlAttr($attr);
        $limit = "'".$tag['limit']."'";
        $sql = 'M(\'slide\')->order(\'listorder desc\')->limit('.$limit.')->select()';
        $parsestr = '<?php $_result='.$sql.';';
        $parsestr .= 'foreach($_result as $key=>$value):';
        $parsestr .= 'extract($value);?>';
        $parsestr .= $content;//解析标签中的内容
        $parsestr .= '<?php endforeach; ?>';
        
        return  $parsestr; 
   }

   public function _user($attr,$content)
   {
        $tag=$this->parseXmlAttr($attr);
        $parsestr = '<?php ';
        $parsestr .= '$login=false;if(isset($_SESSION[\'user\']))$login=true;';
        $parsestr .= 'extract($_SESSION[\'user\']);';
        $parsestr .= '$url=U(\'UserCenter\');';
        $parsestr .= ' ?>';
        $parsestr .= $content;//解析标签中的内容

        return $parsestr;
   }
   
}

?>
