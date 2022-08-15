@extends("layouts.app")

@section("content")

    <div class="flex justify-center flex-wrap p-4 mt-5">
       

    <div class="grid grid-cols-12 gap-2">
            <div class="col-span-3" ></div>

            
            <div class="col-span-3">
                <div class="grid bg-white rounded-lg shadow-xl mx-auto">
                    <form method="POST" enctype="multipart/form-data" action="{{route('importarVelocidades')}}">
                        @csrf
                        <div class="grid grid-cols-1 mt-5 mx-7 ">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1" >Importar archivo de velocidades</label>
                            <div class='flex items-center justify-center w-full'>
                                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                    <div class='flex flex-col items-center justify-center pt-7'>
                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"></path></svg>
                                        <center><span value="file"class="block text-gray-400 font-normal" id="nombreArchivoVelocidades" name="nombreArchivoVelocidades">Selecciona el archivo</span>
                                    </div>
                                    <input type="file" class="form-control h-full w-full opacity-0" id="velocidades" name="velocidades" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                </label>
                            </div>
                        </div>
                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            <button class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancel</button>
                            <button type="file" name="file" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Subir</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-span-3">
                <div class="grid bg-white rounded-lg shadow-xl mx-auto">
                    <form method="POST" enctype="multipart/form-data" action="">
                        @csrf
                        <div class="grid grid-cols-1 mt-5 mx-7 ">
                            <label class="uppercase md:text-sm text-xs text-gray-500 text-light font-semibold mb-1">Importar velocidades</label>
                            <div class='flex items-center justify-center w-full'>
                                <label class='flex flex-col border-4 border-dashed w-full h-32 hover:bg-gray-100 hover:border-purple-300 group'>
                                    <div class='flex flex-col items-center justify-center pt-7'>
                                        <svg class="w-10 h-10 text-purple-400 group-hover:text-purple-600" fill="none" stroke="currentColor" viewBox="0 0 24 24" xmlns="http://www.w3.org/2000/svg"><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M16.88 9.1A4 4 0 0 1 16 17H5a5 5 0 0 1-1-9.9V7a3 3 0 0 1 4.52-2.59A4.98 4.98 0 0 1 17 8c0 .38-.04.74-.12 1.1zM11 11h3l-4-4-4 4h3v3h2v-3z"></path></svg>
                                        <center><span class="block text-gray-400 font-normal" id="subirVelocidades" name="subirVelocidades" >Selecciona el archivo CSV</span></center>
                                    </div>
                                    <input type="file" class="form-control h-full w-full opacity-0" id="plantillaReportes" name="plantillaReportes" accept="application/vnd.openxmlformats-officedocument.spreadsheetml.sheet" required>
                                </label>
                            </div>
                        </div>
                        <div class='flex items-center justify-center  md:gap-8 gap-4 pt-5 pb-5'>
                            <button class='w-auto bg-gray-500 hover:bg-gray-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Cancel</button>
                            <button type="file" name="file" class='w-auto bg-purple-500 hover:bg-purple-700 rounded-lg shadow-xl font-medium text-white px-4 py-2'>Subir</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="col-span-3"></div>
        </div>
        

























    </div>

@endsection