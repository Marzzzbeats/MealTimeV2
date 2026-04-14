try{
        const res = await fetch('../lib/auth_check.php');
        if(res.ok){
            let data = await res.json();
            const user = data.user;
            if(!user.connected){
                window.location.href='../index.html';
            }
        }
}catch(err){
        console.error(err.message);
}