<?php
/* Template Name: Tafelrunde Layout */
get_header(); ?>

<main class="site-content tafelrunde-page">
	<div class="tafelrunde-container">

		<section class="members-column">
			<?php
			$args = array('post_type' => 'ritter', 'posts_per_page' => -1, 'order' => 'ASC');
			$ritter_query = new WP_Query($args);

			if ($ritter_query->have_posts()) :
				while ($ritter_query->have_posts()) : $ritter_query->the_post(); ?>
					<article class="ritter-card">
						<div class="ritter-photo">
							<?php the_post_thumbnail('medium'); ?>
						</div>

						<?php
						$wappen_url = get_post_meta(get_the_ID(), 'ritter_wappen', true);
						if ($wappen_url) : ?>
							<div class="ritter-wappen-container">
								<img src="<?php echo esc_url($wappen_url); ?>" class="ritter-wappen-img">
							</div>
						<?php endif; ?>

						<div class="ritter-details">
							<h2><?php the_title(); ?></h2>
							<div class="ritter-bio">
								<?php the_content(); ?>
							</div>
						</div>
					</article>
			<?php endwhile;
				wp_reset_postdata();
			else :
				echo '<p>Noch sind keine Recken an der Tafelrunde versammelt.</p>';
			endif;
			?>
		</section>

		<div class="global-info-dropdown">
			<div class="info-button" onclick="toggleInfoDropdown()">
				<span>Mehr zu den Ordensrängen</span>
				<span class="info-icon-circle">i</span>
			</div>
			<div id="info-content" class="info-content-box">
				<p>
					Die Orden der ritterlichen Bünde in Österreich sind hierarchisch geordnet. Ebenso ist es im OMCCT bestellt. Als Pilgrim beginnt man die Suche und die ersten Treffen mit den Ordensrittern finden statt. Auf Empfehlung eines Recken wird nach einer geraumen Zeit um die Aufnahme als Knappe erbeten. Die Knappen Aufnahme erfolgt in einer ehrenvollen Zeremonie, meist im Rahmen des Jahreshauptkapitelums stattfindet.

					Dabei bittet der künftige Leibrecke (in etwa so etwas wie ein Lehrmeister) um die Aufnahme des Pilgrims als Knappe. Der Knappe erhält dabei einen Waffenrock in den Ordensfarben und ein Barett, das die Farbe Purpur hat.

					-

					Beim Ritterschlag Profess Ritter erhalten der bzw. die Lady alle Insignien. Das heißt, den Mantel und das Ordenskreuz bzw. Ordens Scherpe.
				</p>
			</div>
		</div>

	</div>
</main>

<script>
	function toggleInfoDropdown() {
		var content = document.getElementById("info-content");
		content.classList.toggle("active");
	}

	// Schließen, wenn man irgendwo anders hinklickt
	window.onclick = function(event) {
		if (!event.target.matches('.info-button') && !event.target.closest('.info-button')) {
			var dropdowns = document.getElementsByClassName("info-content-box");
			for (var i = 0; i < dropdowns.length; i++) {
				var openDropdown = dropdowns[i];
				if (openDropdown.classList.contains('active')) {
					openDropdown.classList.remove('active');
				}
			}
		}
	}
</script>
<?php get_footer(); ?>
