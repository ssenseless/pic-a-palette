import Home from "./pages/Home/Home";
import About from "./pages/About/About";
import Register from "./pages/Register/Register";
import Profile from "./pages/Profile/Profile";
import Palette from "./pages/Palette/Palette";


import AboutHeader from "./pages/About/AboutHeader";
import AboutFooter from "./pages/About/AboutFooter";
import RegisterHeader from "./pages/Register/RegisterHeader";
import RegisterFooter from "./pages/Register/RegisterFooter";
import ProfileHeader from "./pages/Profile/ProfileHeader";
import ProfileFooter from "./pages/Profile/ProfileFooter";
import PaletteHeader from "./pages/Palette/PaletteHeader";
import PaletteFooter from "./pages/Palette/PaletteFooter";


import {BrowserRouter as Router, Route, Switch} from "react-router-dom";



function App() {
  return <div>
    <Router>
      <Switch>
        <Route exact path="/">
          <Home/>
        </Route>
        <Route path="/about">
          <AboutHeader />
          <About/>
          <AboutFooter />
        </Route>
        <Route path="/register">
          <RegisterHeader/>
          <Register/>
          <RegisterFooter/>
        </Route>
        <Route path="/profile">
          <ProfileHeader/>
          <Profile/>
          <ProfileFooter/>
        </Route>
        <Route path="/palette-creation">
          <PaletteHeader/>
          <Palette/>
          <PaletteFooter/>
        </Route>
      </Switch>
    </Router>
  </div>;
}

export default App;
