<?php
/*
 * Adiciona ao Admin Control Panel (ACP)
 */

 //  Usa o action hook 'admin_menu', roda a função 'mmp_Adiciona_Admin_Link()'
 defined( 'ABSPATH' ) or die( 'Crianças, não brinquem com script!' );

// Adiciona um menu link ao ACP
add_action( 'admin_menu', 'mmp_Adiciona_Admin_Link' );
function mmp_Adiciona_Admin_Link()
{
    add_menu_page(
        'A página do MMP', // Titulo da página
        'Manchete Multisites', // Texto mostrado no menu link
        'manage_options', // Nivel de acesso
        'includes/mmp-primeira-pagina-acp.php' // O 'slug' - arquivo mostrado ao clicar
    );
}

function chamamanchete($catcapa, $layout, $numposts, $maisnovo){
    $qcat = count($catcapa);
    //print_r($catcapa);
    switch ($layout) {
        case 1:
            $nomlay = "manchete";
            break;
        case 2:
            $nomlay = "3colsemdata";
            break;
        case 3:
            $nomlay = "curtassemdata";
            break;
        case 4:
            $nomlay = "curtascomdata";
           break;
        default:
            $nomlay = "manchete";
            break;
        }

    for ( $i=1; $i<=$qcat; $i++) {
        switch_to_blog($i);
        $blog_id = get_current_blog_id(); 
        $h = $i-1;
        $args = array(
            'category'				=> $catcapa[$h],
            'orderby'			=>'date',
            'order'				=>'DESC',
            'number_posts'	=> $numposts,
            );
        $resulta = get_posts( $args );
        
        //if ( $busca[$e]->have_posts() ) {
        for ($g = 1; $g<=$numposts;$g++) {
            $f = $g-1;
            $datadopost = $resulta[$f]->post_date;   
            if (!empty ($datadopost)) {
            $busca[] = array ($datadopost, $resulta[$f]->post_name, $blog_id);
            }
        }
        restore_current_blog();
    }   
    ordenamanchete($busca, $nomlay, $maisnovo);
    return;
}

/* ordena o resultado da varredura dos sites */
function ordenamanchete($busca, $nomlay, $maisnovo) {
    $manchete = $busca;
    if (!empty ($manchete)) {
        usort($manchete,function($b, $a){ if ($a==$b) return 0; return ($a<$b)?-1:1;});
        switch ($maisnovo) {
            case 'sim':
                $numposts = 1;
                break;
            case 'nao':
                $numposts = (count($manchete));
                break;
        }
        for ($l = 0; $l<$numposts;$l++) {
            $blog = $manchete[$l][2];
            $refpost = $manchete[$l][1];
            echo '<div style="margin: 0; float: none; padding: 0;">'. do_shortcode('[gknsp article_cols="1" article_rows="1" cache_time="0" data_source_type="wp-post" data_source="' . $refpost . '" data_source_blog = "' . $blog .'" article_format="' . $nomlay .'.format" orderby="date" order="DESC" article_wrapper="default" article_block_padding = "0px 0" offset = "0" use_css = "on" article_title_len_type="words" article_title_len="30"]') . '</div>';
        }
        return;
    }
    else
    {
        echo "<h3>Nenhum post encontrado nos sites pesquisados!";
    }
}

function mmp_pagina_html() {
    ?>
    <div class="wrap">
          <h1>Eita!</h1>
          <p>Esta é a minha primeira página de plugin</p>
      <?php /*  <h1><?php echo esc_html( get_admin_page_title() ); ?></h1> */ ?>
       <form action="options.php" method="post">
        <?php
        // output security fields for the registered setting "wporg_options"
        // settings_fields( 'mmp_options' );
        // output setting sections and their fields
        // (sections are registered for "mmp", each field is registered to a specific section)
        //do_settings_sections( 'mmp' );
        // output save settings button
        //submit_button( __( 'Salvar configurações', 'textdomain' ) );
        ?>
      </form>
    </div>
    <?php
}

