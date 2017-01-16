<?php

class GetMenuItemList extends CI_Model {
	
	public function __construct()
        {
                $this->load->database('krazytable');
        }

	public function getItem($value){
		$query = null;

		/**$query = "select A.item_unique_id as ItemId, A.display_name as ItemName, A.display_content as Description, B.average_rating as Rating, A.full_plate_price as FullPrice, A.half_plate_price as HalfPrice, A.small_plate_price as SmallPrice, A.preparation_time as PrepTime from tbl_mast_restaurant_menu_item A, tbl_summary_item_rating B where A.restaurant_id_pk1_fk = B.restaurant_id_pk2_fk and A.sub_category_1 = ? and A.menu_item_pk2_fk = B.menu_item_pk1_fk and A.restaurant_id_pk1_fk = ? ";
**/
/**		$query ="select A.item_unique_id as ItemId, A.menu_item_pk2_fk as ItemName, A.display_content as Description, B.average_rating as Rating, (select C.price from tbl_detail_restaurant_menu_price C inner join tbl_mast_menu_size D on C.size_id_fk = D.size_id_pk where A.restaurant_id_pk1_fk = C.restaurant_id_pk_fk and A.menu_item_pk2_fk = C.menu_item_pk_fk and D.plate_size='L') as FullPrice, (select C.price from tbl_detail_restaurant_menu_price C inner join tbl_mast_menu_size D on C.size_id_fk = D.size_id_pk where A.restaurant_id_pk1_fk = C.restaurant_id_pk_fk and A.menu_item_pk2_fk = C.menu_item_pk_fk and D.plate_size='M') as HalfPrice, (select C.price from tbl_detail_restaurant_menu_price C inner join tbl_mast_menu_size D on C.size_id_fk = D.size_id_pk where A.restaurant_id_pk1_fk = C.restaurant_id_pk_fk and A.menu_item_pk2_fk = C.menu_item_pk_fk and D.plate_size='S') as SmallPrice, A.preparation_time as PrepTime from tbl_mast_restaurant_menu_item A left join tbl_summary_item_rating B on A.restaurant_id_pk1_fk = B.restaurant_id_pk2_fk and A.menu_item_pk2_fk = B.menu_item_pk1_fk where A.sub_category_1 = ? and A.restaurant_id_pk1_fk = ?";
**/

		$query = "select A.item_unique_id as ItemId, A.menu_item_pk2_fk as ItemName, A.display_content as Description, B.average_rating as Rating, (select C.price from tbl_detail_restaurant_menu_price C inner join tbl_mast_menu_size D on C.size_id_fk = D.size_id_pk where A.item_unique_id = C.item_unique_id_fk and D.plate_size='L') as FullPrice, (select C.price from tbl_detail_restaurant_menu_price C inner join tbl_mast_menu_size D on C.size_id_fk = D.size_id_pk where A.item_unique_id = C.item_unique_id_fk and D.plate_size='M') as HalfPrice, (select C.price from tbl_detail_restaurant_menu_price C inner join tbl_mast_menu_size D on C.size_id_fk = D.size_id_pk where A.item_unique_id = C.item_unique_id_fk and D.plate_size='S') as SmallPrice, A.preparation_time as PrepTime from tbl_mast_restaurant_menu_item A left join tbl_summary_item_rating B on A.restaurant_id_pk1_fk = B.restaurant_id_pk2_fk and A.menu_item_pk2_fk = B.menu_item_pk1_fk where A.sub_category_1 = ? and A.restaurant_id_pk1_fk = ?";

	
		$queryResult = $this->db->query($query, array($value['subCategory1'], $value['restId']))->result();

		if(empty($queryResult)){
			#$dbError = $this->db->error();
			#throw new Exception($dbError['message']);
			throw new Exception('No rows returned', EXIT_DATABASE);
		}else {
			return $queryResult;
		}

	}

	public function getSubCategory1($value){
                $query = null;

                $query = "select distinct category_1_id, sub_category_pk2 from tbl_detail_display_restaurant_menu_sub_category_1 where restaurant_id_pk_fk= ? order by  category_1_id, sub_category_pk2 ";

                $queryResult = $this->db->query($query, array($value['restaurant_id']))->result_array();

                if(empty($queryResult)){
                        throw new Exception('No rows returned', EXIT_DATABASE);
                }else {
                        return $queryResult;
                }

        }

}
