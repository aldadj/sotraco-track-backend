@extends('layouts.app')

@section('title', 'Gestion des Bus')


@section('content')

<div class="admin-container">

    <h1>🚌 Gestion des Bus</h1>


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
                    <th>Actions</th>
                </tr>

            </thead>


            <tbody>


            @forelse($buses as $bus)

                <tr>

                    <td>
                        {{ $bus->number }}
                    </td>


                    <td>
                        {{ $bus->line }}
                    </td>


                    <td>
                        {{ $bus->destination }}
                    </td>


                    <td class="actions">


                        <a href="{{ route('admin.buses.edit',$bus) }}"
                           class="edit-btn">
                            Modifier
                        </a>



                        <form action="{{ route('admin.buses.destroy',$bus) }}"
                              method="POST">

                            @csrf
                            @method('DELETE')


                            <button class="delete-btn">

                                Supprimer

                            </button>


                        </form>


                    </td>


                </tr>



            @empty


                <tr>

                    <td colspan="4">
                        Aucun bus trouvé.
                    </td>

                </tr>


            @endforelse


            </tbody>


        </table>


    </div>




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



            <button>
                Ajouter le bus
            </button>



        </form>


    </div>



</div>


@endsection