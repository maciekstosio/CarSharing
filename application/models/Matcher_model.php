<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Matcher_model extends CI_Model {
    public function get_matches_for_user($uid) {
        $query = $this -> db -> query('SELECT *, (Hour(TIMEDIFF(pend,pstart))*60+Minute(TIMEDIFF(pend,pstart)))/60 diff FROM
                                                (
                                                    SELECT availability.car, cars.price, CONCAT(brands.name, " ", models.name) name, plans.date pdate, plans.start pstart, plans.end pend, availability.date adate, availability.start astart, availability.end aend FROM `users`
                                                    INNER JOIN plans ON users.id=plans.user
                                                    CROSS JOIN availability
                                                    LEFT JOIN cars ON cars.license_plate=availability.car
                                                    LEFT JOIN models ON cars.model=models.id
                                                    LEFT JOIN brands ON brands.id=models.brand
                                                    WHERE users.id = ? AND availability.active=1 AND users.id!=cars.user
                                                    HAVING adate=pdate
                                                ) d
                                                WHERE d.astart<=d.pstart && d.pend <= d.aend', array($uid)); 
        
        if($query) {
            return $query -> result();
        }
        return 0;
    }
}

?>