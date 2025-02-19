<?php
if (!defined('ABSPATH')) {
    exit;
}

class Elementor_Player_Widget extends \Elementor\Widget_Base {

    public function get_name() {
        return 'player';
    }

    public function get_title() {
        return __('Player', 'elementor-player');
    }

    public function get_icon() {
        return 'eicon-headphones';
    }

    public function get_categories() {
        return ['general'];
    }

    protected function _register_controls() {
        // Controle para quantidade de posts (na aba Conteúdo)
        $this->start_controls_section(
            'content_section',
            [
                'label' => __('Content', 'elementor-player'),
                'tab' => \Elementor\Controls_Manager::TAB_CONTENT,
            ]
        );
    
        // Número de posts inicial
        $this->add_control(
            'posts_per_page',
            [
                'label' => __('Number of Posts', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3, // Valor padrão
                'min' => 1, // Valor mínimo
                'max' => 50, // Valor máximo
                'step' => 1, // Incremento
            ]
        );
    
        // Quantidade de posts a carregar ao clicar em "Carregar Mais"
        $this->add_control(
            'load_more_posts_per_page',
            [
                'label' => __('Posts to Load on "Load More"', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::NUMBER,
                'default' => 3, // Valor padrão
                'min' => 1, // Valor mínimo
                'max' => 50, // Valor máximo
                'step' => 1, // Incremento
                'condition' => [
                    'pagination_type' => 'load_more', // Só aparece se o tipo for "Carregar Mais"
                ],
            ]
        );
    
        // Tipo de paginação (Carregar Mais ou Anterior/Próximo)
        $this->add_control(
            'pagination_type',
            [
                'label' => __('Pagination Type', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::SELECT,
                'default' => 'load_more', // Valor padrão
                'options' => [
                    'load_more' => __('Load More', 'elementor-player'),
                    'prev_next' => __('Previous/Next', 'elementor-player'),
                ],
            ]
        );
    
        $this->end_controls_section();

        // Controle para waveColor (na aba Estilo)
        $this->start_controls_section(
            'wave_section',
            [
                'label' => __('Waveform', 'elementor-player'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_control(
            'wave_color',
            [
                'label' => __('Wave Background Color', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff427b5c',
                'selectors' => [
                    '{{WRAPPER}} #waveform wave' => 'stroke: {{VALUE}};', // Aplica a cor da onda
                ],
            ]
        );
    
        $this->add_control(
            'progress_color',
            [
                'label' => __('Wave Progress Color', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff427b',
                'selectors' => [
                    '{{WRAPPER}} #waveform progress' => 'background-color: {{VALUE}};', // Aplica a cor do progresso
                ],
            ]
        );
    
        $this->add_control(
            'cursor_color',
            [
                'label' => __('Cursor Color', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ff427b',
                'selectors' => [
                    '{{WRAPPER}} #waveform cursor' => 'background-color: {{VALUE}};', // Aplica a cor do cursor
                ],
            ]
        );
    
        $this->end_controls_section();
    
        // Controle para botões (na aba Estilo)
        $this->start_controls_section(
            'button_section',
            [
                'label' => __('Control Button', 'elementor-player'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_control(
            'button_background_color',
            [
                'label' => __('Controls Buttons Background Color', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#0073aa',
                'selectors' => [
                    '{{WRAPPER}} .controls button' => 'background-color: {{VALUE}};', // Aplica a cor de fundo dos botões
                ],
            ]
        );
    
        $this->end_controls_section();
    
        // Controle para o player (na aba Estilo)
        $this->start_controls_section(
            'player_section',
            [
                'label' => __('Player', 'elementor-player'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_control(
            'player_background_color',
            [
                'label' => __('Player Background Color', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#ffffff',
                'selectors' => [
                    '{{WRAPPER}} .audio-player' => 'background-color: {{VALUE}};', // Aplica a cor de fundo do player
                ],
            ]
        );
    
        $this->add_control(
            'player_border_color',
            [
                'label' => __('Player Border Color', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#1291ff',
                'selectors' => [
                    '{{WRAPPER}} .audio-player' => 'border-top-color: {{VALUE}};', // Aplica a cor da borda do player
                ],
            ]
        );
    
        $this->end_controls_section();
    
        // Controle para tipografia e cores do texto (na aba Estilo)
        $this->start_controls_section(
            'typography_section',
            [
                'label' => __('Typography', 'elementor-player'),
                'tab' => \Elementor\Controls_Manager::TAB_STYLE,
            ]
        );
    
        $this->add_control(
            'episode_title_color',
            [
                'label' => __('Episode Title Color', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .episode-details h3' => 'color: {{VALUE}};', // Aplica a cor do título
                ],
            ]
        );
    
        $this->add_control(
            'episode_author_color',
            [
                'label' => __('Episode Author Color', 'elementor-player'),
                'type' => \Elementor\Controls_Manager::COLOR,
                'default' => '#333333',
                'selectors' => [
                    '{{WRAPPER}} .episode-details p' => 'color: {{VALUE}};', // Aplica a cor do autor
                ],
            ]
        );
    
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'episode_title_typography',
                'label' => __('Episode Title Typography', 'elementor-player'),
                'selector' => '{{WRAPPER}} .episode-details h3', // Aplica a tipografia do título
            ]
        );
    
        $this->add_group_control(
            \Elementor\Group_Control_Typography::get_type(),
            [
                'name' => 'episode_author_typography',
                'label' => __('Episode Author Typography', 'elementor-player'),
                'selector' => '{{WRAPPER}} .episode-details p', // Aplica a tipografia do autor
            ]
        );
    
        $this->end_controls_section();
    }

    protected function render_pagination($query) {
        $total_pages = $query->max_num_pages;
        $current_page = max(1, get_query_var('paged'));
    
        if ($total_pages > 1) {
            echo '<div class="podcast-pagination">';
    
            // Botão "Carregar Mais" (se não for a última página)
            if ($current_page < $total_pages) {
                echo '<button id="load-more" data-page="' . ($current_page + 1) . '" data-total-pages="' . $total_pages . '">Carregar Mais</button>';
            }
    
            echo '</div>';
        }
    }

    protected function render_load_more($query) {
        $total_pages = $query->max_num_pages;
        $current_page = max(1, get_query_var('paged'));
    
        if ($current_page < $total_pages) {
            echo '<div class="podcast-pagination">
                    <button id="load-more" data-page="' . ($current_page + 1) . '" data-total-pages="' . $total_pages . '">Carregar Mais</button>
                  </div>';
        }
    }
    
    protected function render_prev_next($query) {
        $total_pages = $query->max_num_pages;
        $current_page = max(1, get_query_var('paged'));
    
        if ($total_pages > 1) {
            echo '<div class="podcast-pagination">';
            previous_posts_link('« Anterior');
            next_posts_link('Próximo »', $query->max_num_pages);
            echo '</div>';
        }
    }

    protected function render() {
        $settings = $this->get_settings_for_display();

        // Quantidade de posts definida pelo usuário
        $posts_per_page = $settings['posts_per_page'];
        $pagination_type = $settings['pagination_type'];

        $args = array(
            'post_type' => 'podcast-episodios',
            'posts_per_page' => $posts_per_page, // Usa o valor definido no controle
            'paged' => get_query_var('paged') ? get_query_var('paged') : 1, // Paginação
        );

        $episodios = new WP_Query($args);

        if ($episodios->have_posts()) :
            // Listar os episódios
            echo '<div class="episodios-container">';
            while ($episodios->have_posts()) : $episodios->the_post();
                $data = get_the_date();
                $autor = get_field('autor');
                $audio_url = get_field('audio_do_podcast')['url'];
                $thumb_url = get_the_post_thumbnail_url(get_the_ID(), 'full');
                
                echo '<div class="episodio">
                        <div class="episodio-infos">
                            '.($thumb_url ? '<img src="' . esc_url($thumb_url) . '" alt="' . esc_attr(get_the_title()) . '">' : '').'
                            <p>' . esc_html($data) . '</p>
                            <h2>' . get_the_title() . '</h2>
                            <p>' . esc_html($autor) . '</p>
                        </div>
                        <button class="play-button" 
                                data-audio="' . esc_url($audio_url) . '"
                                data-title="' . esc_attr(get_the_title()) . '"
                                data-thumb="' . esc_url($thumb_url) . '"
                                data-author="' . esc_attr($autor) . '">
                            <span>
                                <svg aria-hidden="true" class="e-font-icon-svg e-fas-play" viewBox="0 0 448 512" xmlns="http://www.w3.org/2000/svg"><path d="M424.4 214.7L72.4 6.6C43.8-10.3 0 6.1 0 47.9V464c0 37.5 40.7 60.1 72.4 41.3l352-208c31.4-18.5 31.5-64.1 0-82.6z"></path></svg>
                            </span>
                            Play
                        </button>
                    </div>';
            endwhile;
            wp_reset_postdata();
            echo '</div>';

            // Paginação
            if ($pagination_type === 'load_more') {
                $this->render_load_more($episodios);
            } else {
                $this->render_prev_next($episodios);
            }
            
            // Player de Áudio
            echo '<div id="audio-player" class="audio-player">
                    <div class="episode-info">
                        <img class="episode-thumb" src="">
                        <div class="episode-details">
                            <h3 class="episode-title"></h3>
                            <p class="episode-author"></p>
                        </div>
                    </div>
                    <div class="controls">
                        <button id="skip-backward">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M370.58-505.85h-33.04q-9.72 0-16.38-6.46-6.66-6.47-6.66-16.56 0-9.51 6.66-16.28 6.66-6.77 16.62-6.77h54.78q9.77 0 16.53 6.75 6.76 6.76 6.76 16.29v177.26q0 9.53-6.6 16.04-6.6 6.5-16.12 6.5-9.51 0-16.03-6.5-6.52-6.51-6.52-16.04v-154.23Zm133.2 176.77q-16.93 0-28.18-11.15-11.25-11.16-11.25-27.84v-143.85q0-16.81 11.28-28.41 11.29-11.59 28.16-11.59h74.08q16.68 0 28.06 11.59 11.38 11.6 11.38 28.41v143.85q0 16.68-11.31 27.84-11.31 11.15-27.88 11.15h-74.34Zm10.45-45.27h53.19q2.31 0 3.47-1.05 1.15-1.06 1.15-3.56v-122.27q0-2.31-1.15-3.46-1.16-1.16-3.47-1.16h-53.19q-2.5 0-3.56 1.16-1.06 1.15-1.06 3.46v122.27q0 2.5 1.06 3.56 1.06 1.05 3.56 1.05Zm-34.21 266.27q-69.17 0-129.65-26.21-60.48-26.21-105.58-71.31-45.1-45.09-71.31-105.56t-26.21-129.65q0-11.63 8.23-19.85 8.22-8.22 19.86-8.22 11.45 0 19.66 8.22t8.21 19.85q0 115.39 80.69 196.08 80.7 80.69 196.08 80.69 115.38 0 196.08-80.36 80.69-80.35 80.69-196.02 0-115.46-80.69-195.91-80.7-80.44-196.08-80.44h-11.42l43.77 43.58q8.42 8.36 8.21 19.61-.21 11.25-8.63 19.81-8.89 8.31-19.85 8.46-10.96.16-19.27-8.34l-87.37-87.75q-10.67-10.48-10.67-24.23 0-13.74 10.54-24.1l87.69-87.3q8.5-8.51 19.9-8.55 11.41-.03 20.54 8.58 8.18 8.81 8.23 19.96.06 11.16-8.55 19.77l-44.54 44.54H480q69.18 0 129.65 26.21 60.46 26.21 105.46 71.13Q760.1-630.48 786.42-570q26.31 60.48 26.31 129.48 0 68.87-26.21 129.5-26.21 60.63-71.31 105.58-45.1 44.94-105.56 71.15-60.46 26.21-129.63 26.21Z"/></svg>
                        </button>
                        <button id="play-pause">Play</button>
                        <button id="skip-forward">
                            <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M480.02-108.08q-69.17 0-129.65-26.21-60.48-26.21-105.58-71.15-45.1-44.95-71.31-105.56t-26.21-129.73q0-68.73 26.31-129.24 26.32-60.5 71.31-105.42 45-44.92 105.46-71.13 60.47-26.21 129.65-26.21h11.42l-44.34-44.54q-8.81-8.61-8.75-19.77.05-11.15 8.42-19.96 8.94-8.61 20.35-8.58 11.4.04 19.9 8.54l87.81 87.24q10.42 10.61 10.42 24.35 0 13.75-10.35 23.91l-87.5 87.89q-8.5 8.5-19.46 8.34-10.96-.15-20.09-8.46-8.18-8.31-8.39-19.65-.21-11.34 8.41-19.77l43.57-43.58H480q-115.38 0-196.08 80.36-80.69 80.36-80.69 195.83 0 115.66 80.69 196.1 80.7 80.44 196.08 80.44 115.38 0 196.08-80.69 80.69-80.69 80.69-196.08 0-11.63 8.22-19.85 8.23-8.22 19.87-8.22 11.45 0 19.66 8.22t8.21 19.85q0 69.18-26.21 129.65T715.21-205.6q-45.1 45.1-105.56 71.31t-129.63 26.21ZM370.58-505.85h-33.04q-9.72 0-16.38-6.46-6.66-6.47-6.66-16.56 0-9.51 6.66-16.28 6.66-6.77 16.62-6.77h54.78q9.77 0 16.53 6.75 6.76 6.76 6.76 16.29v177.26q0 9.53-6.6 16.04-6.6 6.5-16.12 6.5-9.51 0-16.03-6.5-6.52-6.51-6.52-16.04v-154.23Zm133.2 176.77q-16.93 0-28.18-11.15-11.25-11.16-11.25-27.84v-143.85q0-16.81 11.28-28.41 11.29-11.59 28.16-11.59h74.08q16.68 0 28.06 11.59 11.38 11.6 11.38 28.41v143.85q0 16.68-11.31 27.84-11.31 11.15-27.88 11.15h-74.34Zm10.45-45.27h53.19q2.31 0 3.47-1.05 1.15-1.06 1.15-3.56v-122.27q0-2.31-1.15-3.46-1.16-1.16-3.47-1.16h-53.19q-2.5 0-3.56 1.16-1.06 1.15-1.06 3.46v122.27q0 2.5 1.06 3.56 1.06 1.05 3.56 1.05Z"/></svg>
                        </button>
                        <button id="speed-toggle">1x</button>
                        <div id="waveform"></div>
                        <div class="volume-container">
                            <button id="volume-icon">
                                <svg xmlns="http://www.w3.org/2000/svg" height="24px" viewBox="0 -960 960 960" width="24px" fill="#FFFFFF"><path d="M800-481q0-92-52-166.5T612-758q-14-5.42-19-18.21-5-12.79 2-26.31 6-14.48 20-19.98t29 .36Q747-778 809-686.18q62 91.83 62 205Q871-368 809-276T644-139.86q-15 5.86-29 .36t-20-19.78q-7-13.33-2-26.68T612-205q84-35 136-109.5T800-481ZM263.52-335H137q-21 0-34.5-13.5T89-382v-196q0-19.88 13.5-33.94Q116-626 137-626h126.52L419-780q22-23 51.5-11t29.5 43v535q0 32.19-29.5 44.09Q441-157 419-180L263.52-335ZM691-480q0 53-27.5 96.5T586-316q-10 5-18-1t-8-16.91v-293.18q0-10.91 8-16.41t18-.5q50 24 77.5 68t27.5 96Z"/></svg>
                            </button>
                            <input type="range" id="volume-slider" class="volume-slider" min="0" max="1" step="0.1" value="1">
                        </div>
                    </div>
                  </div>';
        else :
            echo '<p>Nenhum episódio encontrado.</p>';
        endif;
    }
}
?>