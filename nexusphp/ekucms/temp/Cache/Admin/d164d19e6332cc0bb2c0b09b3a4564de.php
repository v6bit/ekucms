<?php if (!defined('THINK_PATH')) exit();?><?php if(is_array($stype_list)): $i = 0; $__LIST__ = $stype_list;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$stype): ++$i;$mod = ($i % 2 )?><?php
    $str = '';
    foreach($mcidArr as $v)
    {
   		if ($stype['m_cid'] == $v)
        {
            $str = 'checked="checked"';
            break;
        }
    }
    ?>
	<input type="checkbox" name="stype_mcids[]" <?php echo ($str); ?>  value="<?php echo ($stype['m_cid']); ?>"/><?php echo ($stype['m_name']); ?><?php endforeach; endif; else: echo "" ;endif; ?>