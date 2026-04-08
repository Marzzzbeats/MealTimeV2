document.addEventListener('DOMContentLoaded', async ()=>{
    try{
        const res = await fetch('../../lib/auth_check.php');
        if(res.ok){
            let data = await res.json();
            const login = document.querySelector('#login');
            const register = document.querySelector('#register');
            const logout = document.querySelector('#logout');
            const user = data.user;
            if(data.connected == true && data.user != null){
                const hello = document.createTextNode(`Bonjour ${user.nom}`);
                login.classList.add("hidden");
                register.classList.add("hidden");
                logout.classList.remove("hidden");
                document.appendChild(hello);
            }
        }
    }catch(err){
        console.error(err.message());
    }
})