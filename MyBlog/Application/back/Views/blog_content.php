<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>个人博客</title>
<link rel="stylesheet" href="css/bootstrap.min.css">
<link rel="stylesheet" href="css/bootstrap.css"><!-- 去掉模糊框的暗色背景-->
<link rel="stylesheet" href="css/bootstrap-theme.min.css">
<script src="js/bootstrap.min.js"></script>
<script src="jQuery/jquery-3.1.1.min.js"></script>
<script src="js/bootstrap-dropdown.min.js"></script>

<script src="js/jquery.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script src="js/delete_blog.js"></script>
<link href="css/blog_content.css" rel="stylesheet">
<link href="css/common.css" rel="stylesheet">
</head>

<body>
<?php
    for ($i = 0; $i<count($result)-1; $i++) {

        ?>
        <div class="blog-div">
            <div class="blog-img-box fl">
                <a href="index.php?p=back&a=blog_detail&id=<?php echo $result[$i]["aid"] ?>" target="_blank">
                    <img class="blog-list-img" src="<?php echo $result[$i]["img"] ?>" width="215" height="144" alt=" <?php echo $result[$i]["atitle"] ?>">
                </a>
            </div>
            <div class="blog-content">
                <h3 class="title-h3">
                    <a href="index.php?p=back&a=blog_detail&id=<?php echo $result[$i]["aid"]?>" target="_blank">
                        <?php echo $result[$i]["atitle"] ?>
                    </a>
                </h3>

                <p class="blog-info">
                    <?php echo $result[$i]["content"] ?>
                </p>

                <div class="author-info">
                    <div class="author">
                        <a href="#">
                            <span>作者：<?php echo $result[$i]["mname"] ?></span>
                        </a>
                    </div>
                    <div class="date-time">
                        <em>
                            <?php echo $result[$i]["atime"] ?>
                        </em>
                    </div>
                    <div class="blog-type">
                        分类：<a href="#"><?php echo $result[$i]["tname"] ?></a>
                    </div>

                    <div class="blog-edit">
                       <a href="index.php?p=back&a=update_blog&id=<?php echo $result[$i]["aid"]?>" target="_blank">编辑</a>
                    </div>

                    <div class="blog-delete">
                        <a href="#" onclick="deleteBlog(<?php echo $result[$i]["aid"]?>)">删除</a>
                    </div>
                </div>
            </div>

        </div>

<?php
    }
?>
<?php
//分页的处理
//义页码列表的长度，5个长
//第一条：如果总页数<=5，那么页码列表为1 ~ totaPage 从第一页到总页数
$begin = 1;
$end = 5;
if($result['pageBean']['totaPage']<=5){
    $begin = 1;
    $end = $result['pageBean']['totaPage'];
}else{
    //总页数>5的情况
    //第二条：按公式计算，让列表的头为当前页-2；列表的尾为当前页+2
    $begin = $result['pageBean']['totaPage'] - 2;
    $end = $result['pageBean']['totaPage'] + 2;
}

?>

<?php
//处理没有博文时候分页的显示
        if(count($result)>1){
 ?>



<div class="pull-right"><!--右对齐--->
    <ul class="pagination _pagination">
        <li class="disabled"><a href="#">第<?php echo $result['pageBean']['pageCode']?>页/共<?php echo $result['pageBean']['totaPage']?>页</a></li>
        <li><a href="index.php?<?php echo $result['pageBean']['url']?>&pageCode=1">首页</a></li>
        <li><a href="index.php?<?php echo $result['pageBean']['url']?>&pageCode=<?php echo ($result['pageBean']['pageCode']-1)<0 ? $result['pageBean']['pageCode'] : $result['pageBean']['pageCode']-1 ?>">&laquo;</a></li><!-- 上一页 -->

        <?php
        //循环显示页码列表
        for($i = $begin; $i<=$end; $i++){
            //如果是当前页则设置无法点击超链接
            if($i == $result['pageBean']['pageCode']){


                ?>
                <li class="active"><a><?php echo $i?></a><li>
                <?php
            }else{
                ?>

                <li><a href="index.php?<?php echo $result['pageBean']['url']?>&pageCode=<?php echo $i?>"><?php echo $i?></a></li>
                <?php
            }
        }
        ?>



        <li><a href="index.php?<?php echo $result['pageBean']['url']?>&pageCode=<?php echo ($result['pageBean']['pageCode']+1)> $result['pageBean']['totaPage'] ? $result['pageBean']['totaPage'] : $result['pageBean']['pageCode']+1?>" >&raquo;</a></li>

        <li><a href="index.php?<?php echo $result['pageBean']['url']?>&pageCode=<?php echo $result['pageBean']['totaPage']?>">尾页</a></li>
    </ul>
</div>
<?php
        }
?>

</body>

<div class="modal fade" id="modal_info" tabindex="-1" role="dialog" aria-labelledby="addModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="infoModalLabel">提示</h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-lg-12" id="div_info"></div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" id="btn_info_close" data-dismiss="modal">关闭</button>
            </div>
        </div>
    </div>
</div>
</html>
