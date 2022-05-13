<?php
$cont = '0';

if (empty($doctor->img_url)) {
  $cont = $cont + 1;
}
if (empty($doctor->address)) {
  $cont = $cont + 1;
}
if (empty($doctor->amount_to_pay)) {
  $cont = $cont + 1;
}
if (empty($doctor->specialties)) {
  $cont = $cont + 1;
}
if (empty($doctor->profile)) {
  $cont = $cont + 1;
}

$porcentagem = intval(100 / 7) * $cont;
$porcentagem  = (100 - $porcentagem);
echo $teste . '<br>';
echo $cont;


?>
<div class="container-fluid py-4">
  <div class="row">
    <div class="col-xl-6 col-sm-6 mb-xl-0 mb-4">
      <div class="card">
        <div class="card-body p-3">
          <div class="row">
            <div class="col-8">
              <div class="numbers">
                <div class="progress">
                  <div class="progress-bar bg-success" role="progressbar" style="width: <?= $porcentagem; ?>%" aria-valuenow="<?= $porcentagem; ?>" aria-valuemin="0" aria-valuemax="100"></div>
                </div> Perfil <?= $porcentagem; ?> % Completado
                <ul>
                  <li><a href="<?= base_url('profile')?>">Insira suas informações profissionais</a><i class="ni ni-bold-right"></i></li>
                  <li><a href="<?= base_url('schedule/timeSchedule')?>">Defina sua disponibilidade de Atendimento</a><i class="ni ni-bold-right"></i></li>
                </ul>
              </div>
            </div>
            <div class="col-4 text-end">
              <div class="icon icon-shape bg-gradient-primary shadow-primary text-center rounded-circle">
                <i class="ni ni-money-coins text-lg opacity-10" aria-hidden="true"></i>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>



    <div class="col-md-12">
      <br> <br> <br>
      <div class="card">
        <div class="card-body">

          <div id="calendar" class="tab-pane active">
            <div class="">
              <div class="panel-body">
                <aside>
                  <section class="panel">
                    <div class="panel-body">
                      <div id="calendar" class="has-toolbar calendar_view"></div>
                    </div>
                  </section>
                </aside>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>