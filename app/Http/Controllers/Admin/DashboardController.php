<?php
namespace App\Http\Controllers\Admin;
use App\Http\Controllers\Controller;
use App\Models\Informasi;
use App\Models\Galery;
use App\Models\Agenda;
use Illuminate\Http\Request;
class DashboardController extends Controller
{
 /**
 * index
 *
 * @return void
 */
 public function index()
 {
  // Ambil jumlah data untuk masing-masing model
  $informasi = Informasi::count();
  $galery = Galery::count();
  $agenda = Agenda::count();

  return view('admin.dashboard.index', compact('informasi', 'galery', 'agenda'));
 }
}
