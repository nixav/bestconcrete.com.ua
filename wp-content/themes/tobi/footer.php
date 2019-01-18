<?php
/**
 * The template for displaying the footer
 *
 * Contains the closing of the #content div and all content after.
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package Tobi
 */

?>

	</div>

	<footer id="colophon" class="site-footer">
		<div id="wrapper-footer">
            <div>
                <div class="footer-map">
                    <h3>Наше местоположение</h3>
                    <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d2542.897035102875!2d30.5085998154504!3d50.40575647946928!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x40d4cf33d81fad1f%3A0xd362bc58d69cd69e!2z0YPQuy4g0JrQsNC30LDRhtC60LDRjywgOSwg0JrQuNC10LIsIDAyMDAw!5e0!3m2!1sru!2sua!4v1538494693296" width="100%" height="180" frameborder="0" style="border:0" allowfullscreen></iframe>
                    <p>г. Киев, улица Казацкая, 9</p>
                </div>
                <div class="footer-info">
                    <h3>Контакты</h3>
                    <ul class="footer-contacts">
                        <li>Телефоны: <a href="tel:+380672742200">(067)-274-22-00</a>, <a href="tel:+380732742200">(073)-274-22-00</a>, <a href="tel:+380992742200">(099)-274-22-00</a></li>
                        <li>E-mail: <a href="mailto:tobibud2018@gmail.com">tobibud2018@gmail.com</a></li>
                        <li>Понедельник - Пятница: 09:00 - 18:00<br>Суббота, Воскресенье: консультации в телефонном режиме</li>
                    </ul>
                    <h3>Информация</h3>
                    <?php
                    wp_nav_menu( array(
                        'theme_location' => 'footer',
                        'menu_class'     => 'footer-menu',
                        'container'      => false,
                    ) );
                    ?>

                </div>
            </div>
        </div>
        <p class="bottom-footer">© 2018 “TOBI BUD” - Производство и доставка бетона и железобетонных изделий.</p>
	</footer>
</div>

<?php wp_footer(); ?>

</body>
</html>
