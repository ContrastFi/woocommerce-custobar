<?php

namespace WooCommerceCustobar\DataType;

use WooCommerceCustobar\FieldsMap;
use WooCommerceCustobar\DataSource\Product;

defined( 'ABSPATH' ) or exit;

/**
 * Class CustobarProduct
 *
 * Check field descriptions here: https://www.custobar.com/api/docs/products/
 *
 * @package WooCommerceCustobar\DataType
 */
class CustobarProduct extends AbstractCustobarDataType {

	const EXTERNAL_ID                  = 'external_id';
	const PRICE                        = 'price';
	const TYPE                         = 'type';
	const CATEGORY                     = 'category';
	const CATEGORY_ID                  = 'category_id';
	const VENDOR                       = 'vendor';
	const BRAND                        = 'brand';
	const TITLE                        = 'title';
	const IMAGE                        = 'image';
	const DATE                         = 'date';
	const URL                          = 'url';
	const SALE_PRICE                   = 'sale_price';
	const DESCRIPTION                  = 'description';
	const LANGUAGE                     = 'language';
	const VISIBLE                      = 'visible';
	const EXCLUDE_FROM_RECOMMENDATIONS = 'exclude_from_recommendations';
	const TAGS                         = 'tags';
	const UNIT                         = 'unit';
	const WEIGHT                       = 'weight';

	/**
	 * Maps WC_Product object's properties to match the ones used in Custobar.
	 *
	 * @param \WC_Product $product
	 */
	public function __construct( $product ) {
		parent::__construct();

		$this->dataSource = new Product( $product );
	}

	public static function getFieldsMap() {
		return FieldsMap::getProductFields();
	}
}