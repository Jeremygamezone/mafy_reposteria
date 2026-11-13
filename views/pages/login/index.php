<body class="bg-image-04">
    <main class="col-12 col-lg-10 mx-auto">
        <form method="POST" action="?c=usuario&a=Login" class="col-10 col-md-6 mx-auto mt-5">
            <div class="mb-3">
                <label>Usuario</label>
                <input
                    type="text"
                    name="user"
                    class="form-control"
                    required>
            </div>

            <div class="mb-3">
                <label>Contraseña</label>
                <input
                    type="password"
                    name="password"
                    class="form-control"
                    required>
            </div>

            <button type="submit" class="btn btn-primary mx-auto text-center">
                Iniciar sesión
            </button>
        </form>
    </main>
</body>