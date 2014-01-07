<?php if (!defined('THINK_PATH')) exit();?>                <h1>我有话说 <font style="color:#0099d8; font-weight:normal;"></font></h1>
                <div class="pl1"><textarea name="content" id="comment_content" cols="" rows=""></textarea></div>
                <div class="pl2"><input name="" type="button" value=" " onclick="CommentPost();" /><span>140字</span></div>
                
                <!--评论列表 开始-->
                <?php if(!empty($list_comment)): ?><?php if(is_array($list_comment)): $i = 0; $__LIST__ = $list_comment;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$comment): ++$i;$mod = ($i % 2 )?><div class="pl3">
                        <img src="./images/a4.jpg" />
                        <div class="pl3-1">
                            <p><span><?php echo ($comment["floor"]); ?>楼</span> <?php echo (date('Y-m-d',$comment["addtime"])); ?></p>
                            <p><?php echo (remove_xss(htmlspecialchars($comment["content"]))); ?></p>
                        </div>
                        <div class="clear"></div>
                    </div><?php endforeach; endif; else: echo "" ;endif; ?><?php endif; ?>
                
                <!--评论列表 结束-->
                <div class="clear">&nbsp;</div>
                <!----分页 开始---->
                
                <?php if($count > C('user_page_cm')): ?><div class="pag"><?php echo ($pages); ?></div><?php endif; ?>
                <!----分页 结束---->
            </div>