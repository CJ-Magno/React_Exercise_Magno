import { useState, useEffect } from "react";
import axios from "axios";

export default function List() {
    const [data, setData] = useState([]);
    const [Loading, setLoading] = useState(true);

    useEffect(() => {
        axios.get('http://jsonplaceholder.typicode.com/users')
        .then(res => {
            setData(res.data);
            setLoading(false);
        });

    }, []);

    if (Loading) return <p className="loading-message">Loading...</p>;

    return (
        <ul className="user-list">
            {data.map(user => (
                <li key={user.id}>
                    {user.name}
                </li>
            ))}
        </ul>
    )
    
}