<?php

namespace WebApps\Plugin;

use App\Models\Plugin;

class Slider_Plugin extends Plugin
{
    public $name;
    public $icon;
    public $version;
    public $author;

    public function __construct(array $attributes = [])
    {
        parent::__construct($attributes);
        $plugin = json_decode(file_get_contents(__DIR__ . '/plugin.json'), true);
        $this->name = $plugin['name'];
        $this->icon = $plugin['icon'];
        $this->version = $plugin['version'];
        $this->author = $plugin['author'];
    }

    public $options = [
        'slides' => [
            'type' => 'repeater',
            'label' => 'Image Slide',
            'ref' => 'caption',
            'options' => [
                'imageUrl' => [
                    'type' => 'image',
                    'required' => true,
                ],
                'caption' => [
                    'type' => 'text',
                    'label' => 'Image Caption',
                    'maxLength' => 255,
                    'required' => false,
                ]
            ]
        ]
    ];

    public $new = [
        'slides' => [
            [
                'imageUrl' => [
                    'src' => '',
                    'text' => '',
                    'class' => 'hidden',
                    'readonly' => false,
                    'label' => 'Get from URL:',
                ],
                'caption' => ''
            ]
        ]
    ];

    public $preview = [
        'slides' => [
            'each' => '<div class="slider-item" id="slide{index-1}">
                        <img class="w-full" src="{value.imageUrl.src}" alt="{value.caption}" />
                        <div class="absolute bottom-5 left-0 right-0 text-center">
                            <p class="inline-block font-semibold text-sm text-white p-2 bg-gray-800 bg-opacity-60 rounded" data-val="value.caption"></p>
                        </div>
                       </div>'
        ],
        'repeater' => "var slides = document.getElementsByClassName('slider-item');
                        var i;
                        for (i = 0; i < slides.length; i++) {
                            slides[i].classList.remove('show');
                        }      
                        var slide = document.getElementById('slide'+repeater);
                        if (slide) {  
                            slide.classList.add('show');
                        }"
    ];

    public function output($edit = false)
    {
        $this->edit = $edit;
        ob_start();
        require(__DIR__ . '/include/_html.php');
        $html = str_replace(["\r", "\n", "\t"], '', trim(ob_get_clean()));
        $html = preg_replace('/(\s){2,}/s', '', $html);
        return $html;
    }

    public function style()
    {
        return file_get_contents(__DIR__ . '/include/_style.css');
    }

    public function scripts($edit = false)
    {
        if ($edit) {
            return '$("#slide1").addClass("show");';
        } else {
            return file_get_contents(__DIR__ . '/include/_slider.js');
        }
    }
}
