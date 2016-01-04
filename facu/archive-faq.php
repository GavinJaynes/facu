<h1 class="facu-page-title"><?php echo get_option( 'facu_plugin_page_title' ); ?></h1>

<p class="facu-intro"><?php echo get_option( 'facu_plugin_page_content' ); ?></p>

<?php // Output the categories as a list

	$terms = get_terms( 'question-category' );

 	if ( ! empty( $terms ) && ! is_wp_error( $terms ) ) : ?>

	<ul class="nav nav-pills center-pills question-categories">

	<?php	foreach ( $terms as $term ) : ?>

	   <li role="presentation" class="<?php echo $term->slug; ?>">
	   	<a href="#<?php echo $term->slug; ?>"><?php echo $term->name; ?></a>
	   </li>

	<?php endforeach; ?>

	</ul>

 	<?php endif; ?>



<?php
// Output each term and the posts associated with them
foreach ( $terms as $term ) {

	echo '<h2 id="' . $term->slug . '">' . $term->name . '</h2>';

	$args = array(
		'post_type' => 'faq',
		'tax_query' => array(
			array(
				'taxonomy' => 'question-category',
				'field'    => 'slug',
				'terms'    => $term->slug,
			),
		),
	);
	$the_query = new WP_Query( $args );

	if ( $the_query->have_posts() ) {

		echo '<div class="panel-group" id="accordion" role="tablist" aria-multiselectable="true">';

		$i = 0;

		while ( $the_query->have_posts() ) {

			$the_query->the_post(); ?>

			<div class="panel panel-default">
				<div class="panel-heading" role="tab" id="heading-<?php echo $term->slug.'-'.$i; ?>">
					<h4 class="panel-title">
						<a role="button" data-toggle="collapse" data-parent="#accordion" href="#collapse-<?php echo $term->slug.'-'.$i; ?>" aria-expanded="false" aria-controls="collapse-<?php echo $term->slug.'-'.$i; ?>">
							<?php echo get_the_title(); ?>
						</a>
					</h4>
				</div>
				<div id="collapse-<?php echo $term->slug.'-'.$i; ?>" class="panel-collapse collapse" role="tabpanel" aria-labelledby="heading-<?php echo $term->slug.'-'.$i; ?>">
					<div class="panel-body">
						<?php the_content(); ?>
					</div>
				</div>
			</div>

		<?php

		$i++;

		}

		echo '</div>';

	} else {
		// no posts found
	}
	/* Restore original Post Data */
	wp_reset_postdata();

}
