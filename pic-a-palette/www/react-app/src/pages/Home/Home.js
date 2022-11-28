import React from "react";
import { NavLink } from "react-router-dom";
import Login from "../Home/Login/Login";
import './Home.css';

class Home extends React.Component{
    render(){
        return(
            <Login/>
        )
    }
}

export default Home;
