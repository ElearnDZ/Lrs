<?php
/**
 * When an object is type Activity, that activity
 * gets stored individually so we can reference.
 **/
namespace App\Models;
use Jenssegers\Mongodb\Eloquent\Model as Eloquent;

class Activity extends Eloquent {

  /**
   * Our MongoDB collection used by the model.
   *
   * @var string
   */
  protected $collection = 'activites';

  /**
   * For mass assigning which we use for TC statements,
   * set the fillable fields.
   **/
  protected $fillable = array('id', 'definition');


}