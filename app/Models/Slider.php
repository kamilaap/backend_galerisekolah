<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Slider extends Model
{
 use HasFactory;
 /**
 * fillable
 *
 * @var array
 */
 protected $fillable = [
 'image', 'link'
 ];
  /**
     * Accessor untuk mendapatkan URL lengkap dari gambar
     */
    public function getImageAttribute($image)
    {
        return asset('storage/' . $image); // Menyusun URL gambar dengan benar
    }
}
