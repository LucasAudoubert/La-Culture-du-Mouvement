<!DOCTYPE html>
<html <?php language_attributes(); ?>>

<head>
	<meta charset="<?php bloginfo('charset'); ?>">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">

	<?php if (is_front_page()) : ?>
		<title> Coach sportif à Palaiseau – Préparation physique & prévention des blessures | La Culture du Mouvement
		</title>
		<meta name="description" content="Développez un corps fort et sans douleur avec un coaching individuel à Palaiseau. Analyse de mouvement, préparation physique, mobilité et suivi durable. Premier échange gratuit, sans engagement.">
	<?php else : ?>
	<?php endif; ?>

	<?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
	<?php get_template_part('components/header'); ?>