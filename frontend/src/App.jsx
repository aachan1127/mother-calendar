import { useEffect, useState } from "react";

function App() {
    const [message, setMessage] = useState("");

    useEffect(() => {
        fetch("http://localhost/api/health")
            .then((response) => response.json())
            .then((data) => {
                setMessage(data.message);
            })
            .catch((error) => {
                console.error("API通信に失敗しました:", error);
            });
    }, []);

    return (
        <main>
            <h1>母カレンダー</h1>

            <p>Laravel APIからのメッセージ：</p>
            <p>{message}</p>
        </main>
    );
}

export default App;
