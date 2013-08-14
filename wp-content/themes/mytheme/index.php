<?php
/**
 * The main template file.
 *
 * This is the most generic template file in a WordPress theme
 * and one of the two required files for a theme (the other being style.css).
 * It is used to display a page when nothing more specific matches a query.
 * E.g., it puts together the home page when no home.php file exists.
 * Learn more: http://codex.wordpress.org/Template_Hierarchy
 *
 * @package MyTheme
 * @subpackage My_Theme
 */


get_header(); ?>
<div id="slider">
  <?php if ( function_exists('show_nivo_slider') ) { show_nivo_slider(); } ?>
</div>

<div id="container">
  <div id="cases">
    <div class="header">
      <h2>案例作品 <span class="en">CASE WORK</span></h2> <a href="#" class="more">更多&raquo;</a>
      <div class="clear"></div>
    </div>
    <ul>
      <li>
        <img src="wp-content/uploads/2013/08/thumb.jpg" alt="">
        <div class="description">
          <h3>作品Title</h3>
          <p>作品discription,孔子思想是中华民族精神的源头，其人道观思想影响中国几千年，成为主流价值观。</p>
        </div>
      </li>
      <li>
        <img src="wp-content/uploads/2013/08/big_images_06.jpg" alt="">
        <div class="description">
          <h3>作品Title</h3>
          <p>作品discription,孔子思想是中华民族精神的源头，其人道观思想影响中国几千年，成为主流价值观。</p>
        </div>
      </li>
      <li>
        <img src="wp-content/uploads/2013/08/thumb-2.jpg" alt="">
        <div class="description">
          <h3>作品Title</h3>
          <p>作品discription,孔子思想是中华民族精神的源头，其人道观思想影响中国几千年，成为主流价值观。</p>
        </div>

      </li>
      <li>
        <img src="wp-content/uploads/2013/08/big_images_02.jpg" alt="">
        <div class="description">
          <h3>作品Title</h3>
          <p>作品discription,孔子思想是中华民族精神的源头，其人道观思想影响中国几千年，成为主流价值观。</p>
        </div>
      </li>
      <div class="clear"></div>
    </ul>
    <div class="clear"></div>
  </div>
  <div id="about-us">
    <div class="header">
      <h2>关于我们 <span class="en">ABOUT US</span></h2> <a href="#" class="more">更多&raquo;</a>
      <div class="clear"></div>
    </div>
    <p>文化传播有限公司拍摄模特25元全包灵活拍摄方案任意组特。卓亚传媒是珠三角最具影响力的服装摄影机构，是东莞模特公司最专业的行业龙头企业。给需要的品牌量身定做网拍模特艺术的视觉给需要推广的品牌进行网店、电子商务平台视觉打造，运用4A的经验来完善一条龙的摄影模特服务。卓亚公司有专业外模和国内名模，不断的培训模特新人，吸收专业人才，现有专业高级外国模特、高级网拍模特、高级东莞模特培训老师、高级摄影师、高级设计师。</p>

  </div>
  <div id="contacts">
    <div class="header">
      <h2>联系我们 <span class="en">CONTACT US</span></h2> <a href="#" class="more">更多&raquo;</a>
      <div class="clear"></div>
    </div>
    <ul>
      <li>联系人：X先生</li>
      <li>手机：13025103884</li>
      <li>QQ：123456781</li>
      <li>E-mail:example@163.com</li>
      <li>WEB：www.example.com</li>
      <li>地址：广州市天河区XXX</li>
    </ul>

  </div>  
  <div id="news">
    <div class="header">
      <h2>最新资讯 <span class="en">NEWS</span></h2> <a href="#" class="more">更多&raquo;</a>
      <div class="clear"></div>
    </div>
    <ul>
    <?php
    $args = array( 'posts_per_page' => 10, 'offset'=> 0, "orderby"=>"date" );

    $myposts = get_posts( $args );
    foreach ( $myposts as $post ) : setup_postdata( $post ); ?>
      <li>
        <a href="<?php the_permalink(); ?>"><?php the_title(); ?></a>
        <span class="date"><?php the_date("Y/m/d") ?></span>
      </li>
    <?php endforeach; 
    wp_reset_postdata();?>
      
    </ul>
  </div>
  <div class="clear"></div>
</div>

<?php get_footer(); ?>

