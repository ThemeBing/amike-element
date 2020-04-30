<?php 

function amike_social_sharing() {?>
    <ul>
        <li><a href="https://www.facebook.com/sharer/sharer.php?u=<?php the_permalink() ?>"><i class="fab fa-facebook-f"></i></a></li>
        <li><a href="https://twitter.com/home?status=<?php the_permalink() ?>"><i class="fab fa-twitter"></i></a></li>
        <li><a href="https://plus.google.com/share?url=<?php the_permalink() ?>"><i class="fab fa-google-plus-g"> </i></a></li>
        <li><a href="http://www.linkedin.com/shareArticle?mini=true&url=<?php the_permalink() ?>"><i class="fab fa-linkedin-in"></i></a></li>
    </ul>    
	<?php
}