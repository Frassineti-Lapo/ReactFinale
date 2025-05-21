import { useState } from "react";

export default function Inserisci(props) {
    const [scelta, setScelta] = useState(false);
    const [nome, setNome] = useState("");
    const [cognome, setCognome] = useState("");
    const caricaAlunni = props.caricaAlunni
     
    async function salvaAlunno() {
        await fetch("http://localhost:8080/alunni", {
            method: "POST", 
            headers: { "Content-Type": "application/json"},
            body: JSON.stringify({nome: nome ,cognome: cognome})   
        })
        caricaAlunni()
    }

    return (
       
        <div>
            {!scelta ?(
                <button onClick={() => {setScelta(true)}}>Inserisci</button>
            ):(
                <div>
                    Nome <input type="text" onChange={(e) => {setNome(e.target.value)}}></input>
                    Cognome <input type="text" onChange={(e) => {setCognome(e.target.value)}}></input>
                    <button onClick={salvaAlunno}>Save</button>
                    <button onClick={() => {setScelta(false)}}>Annulla</button>
                </div>
            )
        }
        </div>

    )
    
}