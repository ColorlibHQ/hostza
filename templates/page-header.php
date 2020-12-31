<div class="row narrow">
    <div class="col-full s-content__header aos-init aos-animate" data-aos="fade-up">
        <?php 
        if ( is_archive() ){
            the_archive_title('<h1>', '</h1>');
        }elseif ( is_home() ){
            echo '<h1>'.esc_html__( 'Blog', 'hostza' ).'</h1>';
        }elseif(is_search()){
            echo '<h1>'.esc_html__( 'Search Result', 'hostza' ).'</h1>';
        } else{
            the_title( '<h1>', '</h1>' );
        }
        // 
        $content = '';
        if( !is_archive() ){
            $content = hostza_opt( 'hostza_search_header_content' );
        }else{
            $content = hostza_opt( 'hostza_archive_header_content' );
        }
        //
        if( $content ){
            
            echo '<div class="lead">'.hostza_get_textareahtml_output( $content ).'</div>';
        }
        ?>
    </div>
</div>