<?php

/**
 * Events Template parts with variables:
 * Should be call via SqeThemeFunctions:get_template_parts_with_vars('parts/events',['count'=>-1,'columns'=>4]);
 * count = number of event records - default (0) all
 * columns = number of columns either via 1,2,3,4 default is 4 for 
 */
$count = isset($count) ? $count : 0;
$columns = 12 / (isset($columns) ? $columns : 3); // default 4 columns
$events = \Emma\SqeThemeFunctions::get_events($count);

if (count($events) > 0) :?>
<?php foreach($events as $event) : ?>
<div class="cell medium-<?php echo $columns; ?>">
    <div class="item-event">
        <?php ?>
        <div class="title"><?php echo $event['name']; ?></div>
        <div class="date">
            <?php 
                   
                    echo $event['dates']['date'];
                ?>
        </div>
        <?php if(!empty($event['dates']['time'])): ?>
        <div class="time">
            <?php echo $event['dates']['time']; ?>
        </div>
        <?php endif; ?>
        <div class="location">
            <?php if(!empty($event['location']['name'])): ?>
            <div class="location-name">
                <?php echo $event['location']['name'];?>
            </div>
            <?php endif; ?>
            <?php if (!empty($event['location']['address'])): ?>
            <div class="location-address">
                <?php echo $event['location']['address']; ?>
            </div>
            <?php endif;?>
            <?php if (!empty($event['location']['town'])): ?>
            <div class="location-town">
                <?php echo $event['location']['town']; ?>
            </div>
            <?php endif;?>
            <?php if (!empty($event['location']['city'])): ?>
                <div class="location-city">
                    <?php echo $event['location']['city']; ?>
                </div>
            <?php endif;?>
            <?php if (!empty($event['location']['state'])): ?>
                <div class="location-state">
                    <?php echo $event['location']['state']; ?>
                    <?php if (!empty($event['location']['post_code'])): ?>
                    , <?php echo $event['location']['post_code'] ?>
                    <?php endif;?>
                </div>
            <?php endif;?>
            <?php if (!empty($event['location']['country'])): ?>
                <div class="location-country">
                    <?php echo $event['location']['country']; ?>
                </div>
            <?php endif;?>
        </div>
        <div class="excerpt">
            <?php echo  \Emma\SqeThemeFunctions::text($event['content']); ?>
        </div>
        <div class="read-more-container">
            <a href="<?php echo $event['url'];?>" class="read-more">Read more</a>
        </div>

    </div>
</div>
<?php endforeach; ?>
<?php endif;