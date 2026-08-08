@extends('layouts.app')

@section('title', 'Gestion des Bus')


@section('content')

<div class="admin-container">


    <h1>Gestion des Bus</h1>



    @if(session('success'))

        <div class="alert-success">
            {{ session('success') }}
        </div>

    @endif




    <div class="table-container">


        <h2>Liste des bus</h2>



        <table>


            <thead>

                <tr>

                    <th>Numéro</th>

                    <th>Ligne</th>

                    <th>Destination</th>

                    <th>GPS</th>

                    <th>Actions</th>

                </tr>

            </thead>



            <tbody>


            @forelse($buses as $bus)



                <tr>


                    <td data-label="Numéro">

                        {{ $bus->number }}

                    </td>




                    <td data-label="Ligne">

                        {{ $bus->line }}

                    </td>




                    <td data-label="Destination">

                        {{ $bus->destination }}

                    </td>





                    <td data-label="GPS">


                        @if($bus->is_tracking)


                            <span style="color:green;font-weight:bold">

                                🟢 Actif

                            </span>


                        @else


                            <span style="color:red;font-weight:bold">

                                🔴 Désactivé

                            </span>


                        @endif


                    </td>






                    <td data-label="Actions">


                        <div class="actions">





                            {{-- MODIFIER --}}

                            <a href="{{ route('admin.buses.edit',$bus) }}"
                               class="edit-btn">

                                ✏️ Modifier

                            </a>







                            {{-- SUPPRESSION --}}

                            <form action="{{ route('admin.buses.destroy',$bus) }}"
                                  method="POST">


                                @csrf

                                @method('DELETE')



                                <button type="submit"
                                        class="delete-btn"
                                        onclick="return confirm('Supprimer ce bus ?')">

                                    🗑 Supprimer

                                </button>


                            </form>







                            {{-- ACTIVATION GPS --}}

                            <form action="{{ route('admin.buses.tracking',$bus) }}"
                                  method="POST">


                                @csrf

                                @method('PATCH')



                                <button type="submit"
                                    class="{{ $bus->is_tracking ? 'delete-btn':'edit-btn' }}">



                                    @if($bus->is_tracking)


                                        🔴 Désactiver GPS


                                    @else


                                        🟢 Activer GPS


                                    @endif



                                </button>


                            </form>






                        </div>


                    </td>




                </tr>





            @empty



                <tr>

                    <td colspan="5">

                        Aucun bus trouvé.

                    </td>

                </tr>



            @endforelse




            </tbody>


        </table>



    </div>








    {{-- FORMULAIRE AJOUT --}}



    <div class="form-container">



        <h2>

            Ajouter un nouveau bus

        </h2>





        <form action="{{ route('admin.buses.store') }}"
              method="POST">


            @csrf





            <input

            type="text"

            name="number"

            placeholder="Numéro du bus"

            required>







            <input

            type="text"

            name="line"

            placeholder="Ligne"

            required>







            <input

            type="text"

            name="destination"

            placeholder="Destination"

            required>








            <button type="submit">

                Ajouter le bus

            </button>





        </form>




    </div>



</div>


@endsection