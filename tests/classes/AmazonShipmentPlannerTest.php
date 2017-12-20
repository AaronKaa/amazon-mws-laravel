<?php
use Aarcarr\AmazonMws\AmazonShipmentPlanner;

/**
 * Generated by PHPUnit_SkeletonGenerator 1.2.0 on 2012-12-12 at 13:17:14.
 */
class AmazonShipmentPlannerTest extends PHPUnit_Framework_TestCase {

    /**
     * @var AmazonShipmentPlanner
     */
    protected $object;

    /**
     * Sets up the fixture, for example, opens a network connection.
     * This method is called before a test is executed.
     */
    protected function setUp() {
        resetLog();
        $this->object = new AmazonShipmentPlanner('testStore', true, null);
    }

    /**
     * Tears down the fixture, for example, closes a network connection.
     * This method is called after a test is executed.
     */
    protected function tearDown() {
        
    }
    
    public function testSetAddress(){
        $this->assertFalse($this->object->setAddress(null)); //can't be nothing
        $this->assertFalse($this->object->setAddress('address')); //can't be a string
        $this->assertFalse($this->object->setAddress(array())); //can't be empty
        
        $check = parseLog();
        $this->assertEquals('Tried to set address to invalid values',$check[1]);
        $this->assertEquals('Tried to set address to invalid values',$check[2]);
        $this->assertEquals('Tried to set address to invalid values',$check[3]);
        
        $a1 = array();
        $a1['Name'] = 'Name';
        $a1['AddressLine1'] = 'AddressLine1';
        $a1['AddressLine2'] = 'AddressLine2';
        $a1['City'] = 'City';
        $a1['DistrictOrCounty'] = 'DistrictOrCounty';
        $a1['StateOrProvinceCode'] = 'StateOrProvinceCode';
        $a1['CountryCode'] = 'CountryCode';
        $a1['PostalCode'] = 'PostalCode';
        
        $this->assertNull($this->object->setAddress($a1));
        
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('ShipFromAddress.Name',$o);
        $this->assertEquals('Name',$o['ShipFromAddress.Name']);
        $this->assertArrayHasKey('ShipFromAddress.AddressLine1',$o);
        $this->assertEquals('AddressLine1',$o['ShipFromAddress.AddressLine1']);
        $this->assertArrayHasKey('ShipFromAddress.AddressLine2',$o);
        $this->assertEquals('AddressLine2',$o['ShipFromAddress.AddressLine2']);
        $this->assertArrayHasKey('ShipFromAddress.DistrictOrCounty',$o);
        $this->assertEquals('DistrictOrCounty',$o['ShipFromAddress.DistrictOrCounty']);
        $this->assertArrayHasKey('ShipFromAddress.City',$o);
        $this->assertEquals('City',$o['ShipFromAddress.City']);
        $this->assertArrayHasKey('ShipFromAddress.StateOrProvinceCode',$o);
        $this->assertEquals('StateOrProvinceCode',$o['ShipFromAddress.StateOrProvinceCode']);
        $this->assertArrayHasKey('ShipFromAddress.CountryCode',$o);
        $this->assertEquals('CountryCode',$o['ShipFromAddress.CountryCode']);
        $this->assertArrayHasKey('ShipFromAddress.PostalCode',$o);
        $this->assertEquals('PostalCode',$o['ShipFromAddress.PostalCode']);
        
        $a2 = array();
        $a2['Name'] = 'Name2';
        $a2['AddressLine1'] = 'AddressLine1-2';
        $a2['City'] = 'City2';
        $a2['StateOrProvinceCode'] = 'StateOrProvinceCode2';
        $a2['CountryCode'] = 'CountryCode2';
        $a2['PostalCode'] = 'PostalCode2';
        
        $this->assertNull($this->object->setAddress($a2)); //testing reset
        
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('ShipFromAddress.Name',$o2);
        $this->assertEquals('Name2',$o2['ShipFromAddress.Name']);
        $this->assertFalse(isset($o2['ShipFromAddress.AddressLine2']));
        $this->assertFalse(isset($o2['ShipFromAddress.DistrictOrCounty']));
        
    }
    
    public function testSetLabelPreference(){
        $this->assertFalse($this->object->setLabelPreference(null)); //can't be nothing
        $this->assertFalse($this->object->setLabelPreference(5)); //can't be an int
        $this->assertFalse($this->object->setLabelPreference('wrong')); //not a valid value
        $this->assertNull($this->object->setLabelPreference('SELLER_LABEL'));
        $this->assertNull($this->object->setLabelPreference('AMAZON_LABEL_ONLY'));
        $this->assertNull($this->object->setLabelPreference('AMAZON_LABEL_PREFERRED'));
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('LabelPrepPreference',$o);
        $this->assertEquals('AMAZON_LABEL_PREFERRED',$o['LabelPrepPreference']);
    }
    
    public function testSetItems(){
        $this->assertFalse($this->object->setItems(null)); //can't be nothing
        $this->assertFalse($this->object->setItems('item')); //can't be a string
        $this->assertFalse($this->object->setItems(array())); //can't be empty
        
        $break = array();
        $break[0]['Bork'] = 'bork bork';
        
        $this->assertFalse($this->object->setItems($break)); //missing seller sku
        
        $break[0]['SellerSKU'] = 'some sku';
        
        $this->assertFalse($this->object->setItems($break)); //missing quantity
        
        $check = parseLog();
        $this->assertEquals('Tried to set Items to invalid values',$check[1]);
        $this->assertEquals('Tried to set Items to invalid values',$check[2]);
        $this->assertEquals('Tried to set Items to invalid values',$check[3]);
        $this->assertEquals('Tried to set Items with invalid array',$check[4]);
        $this->assertEquals('Tried to set Items with invalid array',$check[5]);
        
        $i = array();
        $i[0]['SellerSKU'] = 'SellerSKU';
        $i[0]['Quantity'] = 'Quantity';
        $i[0]['QuantityInCase'] = 'QuantityInCase';
        $i[0]['Condition'] = 'Condition';
        $i[1]['SellerSKU'] = 'SellerSKU2';
        $i[1]['Quantity'] = 'Quantity2';
        
        $this->assertNull($this->object->setItems($i));
        
        $o = $this->object->getOptions();
        $this->assertArrayHasKey('InboundShipmentPlanRequestItems.member.1.SellerSKU',$o);
        $this->assertEquals('SellerSKU',$o['InboundShipmentPlanRequestItems.member.1.SellerSKU']);
        $this->assertArrayHasKey('InboundShipmentPlanRequestItems.member.1.Quantity',$o);
        $this->assertEquals('Quantity',$o['InboundShipmentPlanRequestItems.member.1.Quantity']);
        $this->assertArrayHasKey('InboundShipmentPlanRequestItems.member.1.QuantityInCase',$o);
        $this->assertEquals('QuantityInCase',$o['InboundShipmentPlanRequestItems.member.1.QuantityInCase']);
        $this->assertArrayHasKey('InboundShipmentPlanRequestItems.member.1.Condition',$o);
        $this->assertEquals('Condition',$o['InboundShipmentPlanRequestItems.member.1.Condition']);
        $this->assertArrayHasKey('InboundShipmentPlanRequestItems.member.1.SellerSKU',$o);
        $this->assertEquals('SellerSKU2',$o['InboundShipmentPlanRequestItems.member.2.SellerSKU']);
        $this->assertArrayHasKey('InboundShipmentPlanRequestItems.member.2.Quantity',$o);
        $this->assertEquals('Quantity2',$o['InboundShipmentPlanRequestItems.member.2.Quantity']);
        
        $i2 = array();
        $i2[0]['SellerSKU'] = 'NewSellerSKU';
        $i2[0]['Quantity'] = 'NewQuantity';
        
        $this->assertNull($this->object->setItems($i2)); //will cause reset
        
        $o2 = $this->object->getOptions();
        $this->assertArrayHasKey('InboundShipmentPlanRequestItems.member.1.SellerSKU',$o2);
        $this->assertEquals('NewSellerSKU',$o2['InboundShipmentPlanRequestItems.member.1.SellerSKU']);
        $this->assertArrayHasKey('InboundShipmentPlanRequestItems.member.1.Quantity',$o2);
        $this->assertEquals('NewQuantity',$o2['InboundShipmentPlanRequestItems.member.1.Quantity']);
        $this->assertArrayNotHasKey('InboundShipmentPlanRequestItems.member.1.QuantityInCase',$o2);
        $this->assertArrayNotHasKey('InboundShipmentPlanRequestItems.member.2.SellerSKU',$o2);
        $this->assertArrayNotHasKey('InboundShipmentPlanRequestItems.member.2.Quantity',$o2);
        
        $this->object->resetItems();
        
        $o3 = $this->object->getOptions();
        $this->assertArrayNotHasKey('InboundShipmentPlanRequestItems.member.1.SellerSKU',$o3);
        $this->assertArrayNotHasKey('InboundShipmentPlanRequestItems.member.1.Quantity',$o3);
    }
    
//    public function testSetShipmentId(){
//        $this->assertFalse($this->object->setShipmentId(null)); //can't be nothing
//        $this->assertFalse($this->object->setShipmentId(5)); //can't be an int
//        $this->assertNull($this->object->setShipmentId('777'));
//        $o = $this->object->getOptions();
//        $this->assertArrayHasKey('ShipmentId',$o);
//        $this->assertEquals('777',$o['ShipmentId']);
//    }
    
    public function testFetchPlan(){
        resetLog();
        $this->object->setMock(true,'fetchPlan.xml');
        
        $this->assertFalse($this->object->fetchPlan()); //no address set yet
        
        $a = array();
        $a['Name'] = 'Name';
        $a['AddressLine1'] = 'AddressLine1';
        $a['City'] = 'City';
        $a['StateOrProvinceCode'] = 'StateOrProvinceCode';
        $a['CountryCode'] = 'CountryCode';
        $a['PostalCode'] = 'PostalCode';
        
        $this->object->setAddress($a);
        $this->assertFalse($this->object->fetchPlan()); //no items set yet
        
        $i = array();
        $i[0]['SellerSKU'] = 'NewSellerSKU';
        $i[0]['Quantity'] = 'NewQuantity';
        $this->object->setItems($i);
        $this->assertNull($this->object->fetchPlan()); //now it is good
        
        $o = $this->object->getOptions();
        $this->assertEquals('CreateInboundShipmentPlan',$o['Action']);
        
        $check = parseLog();
        $this->assertEquals('Single Mock File set: fetchPlan.xml',$check[1]);
        $this->assertEquals('Address must be set in order to make a plan',$check[2]);
        $this->assertEquals('Items must be set in order to make a plan',$check[3]);
        $this->assertEquals('Fetched Mock File: mock/fetchPlan.xml',$check[4]);
        
        return $this->object;
    }
    
//    /**
//     * @depends testFetchPlan
//     */
//    public function testGetData($o){
//        $get = $o->getData();
//        $this->assertInternalType('array',$get);
//        
//        $x = array();
//        $x['AmazonOrderId'] = '058-1233752-8214740';
//        $x['SellerOrderId'] = '123ABC';
//        $x['PurchaseDate'] = '2010-10-05T00:06:07.000Z';
//        $x['LastUpdateDate'] = '2010-10-05T12:43:16.000Z';
//        $x['OrderStatus'] = 'Unshipped';
//        $x['FulfillmentChannel'] = 'MFN';
//        $x['SalesChannel'] = 'Checkout by Amazon';
//        $x['OrderChannel'] = 'OrderChannel';
//        $x['ShipServiceLevel'] = 'Std DE Dom';
//        $a = array();
//            $a['Name'] = 'John Smith';
//            $a['AddressLine1'] = '2700 First Avenue';
//            $a['AddressLine2'] = 'Apartment 1';
//            $a['AddressLine3'] = 'Suite 16';
//            $a['City'] = 'Seattle';
//            $a['County'] = 'County';
//            $a['District'] = 'District';
//            $a['StateOrRegion'] = 'WA';
//            $a['PostalCode'] = '98102';
//            $a['CountryCode'] = 'US';
//            $a['Phone'] = '123';
//        $x['ShippingAddress'] = $a;
//        $x['OrderTotal']['Amount'] = '4.78';
//        $x['OrderTotal']['CurrencyCode'] = 'USD';
//        $x['NumberOfItemsShipped'] = '1';
//        $x['NumberOfItemsUnshipped'] = '1';
//        $x['PaymentExecutionDetail'][0]['Amount'] = '101.01';
//        $x['PaymentExecutionDetail'][0]['CurrencyCode'] = 'USD';
//        $x['PaymentExecutionDetail'][0]['SubPaymentMethod'] = 'COD';
//        $x['PaymentExecutionDetail'][1]['Amount'] = '10.00';
//        $x['PaymentExecutionDetail'][1]['CurrencyCode'] = 'USD';
//        $x['PaymentExecutionDetail'][1]['SubPaymentMethod'] = 'GC';
//        $x['PaymentMethod'] = 'COD';
//        $x['MarketplaceId'] = 'ATVPDKIKX0DER';
//        $x['BuyerName'] = 'Amazon User';
//        $x['BuyerEmail'] = '5vlh04mgfmjh9h5@marketplace.amazon.com';
//        $x['ShipServiceLevelCategory'] = 'Standard';
//        
//        $this->assertEquals($x,$get);
//        
//        $this->assertFalse($this->object->getData()); //not fetched yet for this object
//    }
    
    /**
     * @depends testFetchPlan
     */
    public function testGetPlan($o){
        $x = array();
        $x1 = array();
        $a1 = array();
        $a1['PostalCode'] = '85043';
        $a1['Name'] = 'Amazon.com';
        $a1['CountryCode'] = 'US';
        $a1['StateOrProvinceCode'] = 'AZ';
        $a1['AddressLine1'] = '4750 West Mohave St';
        $a1['City'] = 'Phoenix';
        $x1['ShipToAddress'] = $a1;
        $x1['ShipmentId'] = 'FBA63J76R';
        $x1['DestinationFulfillmentCenterId'] = 'PHX6';
        $x1['LabelPrepType'] = 'NO_LABEL';
        $i1 = array();
        $i1[0]['SellerSKU'] = 'Football2415';
        $i1[0]['Quantity'] = '3';
        $i1[0]['FulfillmentNetworkSKU'] = 'B000FADVPQ';
        $i1[1]['SellerSKU'] = 'TeeballBall3251';
        $i1[1]['Quantity'] = '5';
        $i1[1]['FulfillmentNetworkSKU'] = 'B0011VECH4';
        $x1['Items'] = $i1;
        $x[0] = $x1;
        $x2 = array();
        $a2 = $a1;
        $a2['AddressLine1'] = '6835 West Buckeye Road';
        $x2['ShipToAddress'] = $a2;
        $x2['ShipmentId'] = 'FBA63HGKJ';
        $x2['DestinationFulfillmentCenterId'] = 'PHX3';
        $x2['LabelPrepType'] = 'SELLER_LABEL';
        $i2 = array();
        $i2[0]['SellerSKU'] = 'DVD2468';
        $i2[0]['Quantity'] = '2';
        $i2[0]['FulfillmentNetworkSKU'] = 'X000579L45';
        $x2['Items'] = $i2;
        $x[1] = $x2;
        
        $this->assertEquals($x,$o->getPlan());
        $this->assertEquals($x1,$o->getPlan(0));
        $this->assertEquals($x2,$o->getPlan(1));
        
        $this->assertFalse($this->object->getPlan()); //not fetched yet for this object
    }
    
    /**
     * @depends testFetchPlan
     */
    public function testGetShipmentIdList($o){
        $x = array();
        $x[0] = 'FBA63J76R';
        $x[1] = 'FBA63HGKJ';
        
        $this->assertEquals($x,$o->getShipmentIdList());
        
        $this->assertFalse($this->object->getShipmentIdList()); //not fetched yet for this object
    }
    
    /**
     * @depends testFetchPlan
     */
    public function testGetShipmentId($o){
        $this->assertEquals('FBA63J76R',$o->getShipmentId(0));
        $this->assertEquals('FBA63HGKJ',$o->getShipmentId(1));
        
        $this->assertFalse($o->getShipmentId('wrong')); //not number
        $this->assertFalse($o->getShipmentId(1.5)); //not integer
        $this->assertFalse($this->object->getShipmentId()); //not fetched yet for this object
    }
    
}

require_once(__DIR__.'/../helperFunctions.php');