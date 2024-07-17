@extends('layouts.app')

@section('content')

<section class="py-5">
                <div class="container px-5 mb-5">
                    <div class="text-center mb-5">
                        <h1 class="display-5 fw-bolder mb-0"><span class="text-gradient d-inline">PRÓXIMAMENTE</span></h1>
                    </div>
                    <div class="row gx-5 justify-content-center">
                        <div class="col-lg-11 col-xl-9 col-xxl-8">
                            <!-- Project Card 1-->
                            <div class="card overflow-hidden shadow rounded-4 border-0 mb-5">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center">
                                        <div class="p-5">
                                            <h2 class="fw-bolder">Zig Zapp PREMIUM</h2>
                                            <p>• Linea especial de TriMotos
                                            <br>• Este servicio es nuestro avance donde incluimos este tipo de vehículos que harán de tu viaje algo mas confortable</p><br>
                                        </div>
                                        <img class="img-fluid" src="{{ asset('motos.png') }}" alt="..." />
                                    </div>
                                </div>
                            </div>
                            <!-- Project Card 2-->
                            <div class="card overflow-hidden shadow rounded-4 border-0">
                                <div class="card-body p-0">
                                    <div class="d-flex align-items-center">
                                        <div class="p-5">
                                            <h2 class="fw-bolder">MENSAJERIA DELIVERY</h2>
                                            <p>• Recibe y Envía todo tipo de encargos con ZigZapp!
                                                <br>• Realiza y recibe envíos inmediatos, seguros y responsables con nuestro servicio de entregas</p><br>
                                        </div>
                                        <img class="img-fluid" src="{{ asset('delivery.jpg') }}" alt="..." />
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- Call to action section-->
            <section class="py-5 bg-gradient-primary-to-secondary text-white">
                <div class="container px-5 my-5">
                    <div class="text-center">
                        <h2 class="display-4 fw-bolder mb-4">RÁPIDO, SEGURO Y EFICAZ</h2>
                        <a class="btn btn-outline-light btn-lg px-5 py-3 fs-6 fw-bolder" href="{{ url('/conocenos') }}">Conocenos</a>
                    </div>
                </div>
            </section>
        </main>




@endsection