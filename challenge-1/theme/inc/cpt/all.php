<?php
/**
 * Custom post type loader.
 *
 * Registers the front-page `property` ("stay") post type and wires up its demo
 * data and idempotent seeder. See each required file for detail.
 *
 * @package infra
 */

defined( 'ABSPATH' ) || exit;

require_once __DIR__ . '/property.php';
require_once __DIR__ . '/../data/listings.php';
require_once __DIR__ . '/../data/seed-properties.php';

