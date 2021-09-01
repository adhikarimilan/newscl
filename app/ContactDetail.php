<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App;
class ContactDetail extends Model
{
    protected $fillable=[
      'siteTitle',
      'sitelogo',
      'e_email',
      'email',
      'e_contactNumber',
      'contactNumber',
      'e_mobile',
      'mobile',
      'headertext',
      'footertext',
      'footertextdesc',
      'footersidelinktitle',
      'fax',
      'website',
      'facebookUrl',
      'twitterUrl',
      'googleUrl',
      'instagramUrl',
      'address',
  
    ];
    
}
