<?php

/*
 * This file is auto-generated, do not edit
 */

namespace Recombee\RecommApi\Tests;

use Recombee\RecommApi\Exceptions as Exc;

abstract class InsertToGroupTestCase extends RecombeeTestCase {

    abstract protected function createRequest($set_id,$type,$entity_id,$optional);

    public function testInsertToGroup() {

         //it does not fail when inserting existing item into existing set
         $req = new AddItem('new_item');
         $resp = $this->client->send($req);
         $req = $this->createRequest('entity_id','item','new_item');
         $resp = $this->client->send($req);

         //it does not fail when cascadeCreate is used
         $req = $this->createRequest('new_set','item','new_item2',['cascadeCreate' => true]);
         $resp = $this->client->send($req);

         //it really inserts item to the set
         $req = new AddItem('new_item3');
         $resp = $this->client->send($req);
         $req = $this->createRequest('entity_id','item','new_item3');
         $resp = $this->client->send($req);
         try {

             $this->client->send($req);
             throw new \Exception('Exception was not thrown');
         }
         catch(Exc\ResponseException $e)
         {
            $this->assertEquals(409, $e->status_code);
         }

    }
}

?>
