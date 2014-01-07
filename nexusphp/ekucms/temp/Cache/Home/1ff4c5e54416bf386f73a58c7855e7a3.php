<?php if (!defined('THINK_PATH')) exit();?><?php echo '<?'; ?>
xml version="1.0" encoding="UTF-8" ?>
<urlset xmlns="http://www.sitemaps.org/schemas/sitemap/0.9">
<url>
<loc><?php echo ($weburl); ?></loc>
<lastmod><?php echo date('Y-m-d',time());?></lastmod>
<changefreq>hourly</changefreq>
<priority>1.0</priority>
</url>
<?php if(is_array($listmap)): $i = 0; $__LIST__ = $listmap;if( count($__LIST__)==0 ) : echo "" ;else: foreach($__LIST__ as $key=>$video): ++$i;$mod = ($i % 2 )?><url>
<loc><?php echo get_base_url($weburl,$video['readurl']);?></loc>
<lastmod><?php echo (date('Y-m-d',$video["addtime"])); ?></lastmod>
<changefreq>daily</changefreq>
<priority>0.8</priority>
</url><?php endforeach; endif; else: echo "" ;endif; ?>
</urlset>