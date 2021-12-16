<div class="Slider" id="slider">

    <?php $i = 1;
    foreach ($this->settings['slides'] as $slide) : ?>
        <div class="slider-item <?php echo (($i == 1) && (!$this->edit)) ? 'show' : ''; ?>" id="slide<?php echo $i; ?>">
            <img class="w-full" src="<?php echo $slide['imageUrl']['src']; ?>" alt="<?php echo $slide['caption']; ?>" />
            <?php if ($slide['caption'] !== '') : ?>
                <div class="absolute bottom-5 left-0 right-0 text-center">
                    <p class="inline-block font-semibold text-sm text-white p-2 bg-gray-800 bg-opacity-60 rounded"><?php echo $slide['caption']; ?></p>
                </div>
            <?php endif; ?>
        </div>
    <?php $i++;
    endforeach;
    if ($i == 1) : ?>
        <div class="slider-item show" id="slide<?php echo $i; ?>">
            <img class="w-full" src="https://placehold.it/1920x1080&text=Your first image will appear here" alt="Select Image First" />
            <?php if ($slide['caption'] !== '') : ?>
                <div class="absolute bottom-5 left-0 right-0 text-center">
                    <p class="inline-block font-semibold text-sm text-white p-2 bg-gray-800 bg-opacity-60 rounded"><?php echo $slide['caption']; ?></p>
                </div>
            <?php endif; ?>
        </div>
    <?php endif; ?>

    <button class="prev">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 19l-7-7 7-7" />
        </svg>
    </button>
    <button class="next">
        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 5l7 7-7 7" />
        </svg>
    </button>

    <span class="switch"></span>
</div>