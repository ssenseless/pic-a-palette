import "./App.css";
import ImageSlider from "./pages/Home/Silders/ImageSlider";
import { SliderData } from "./pages/Home/Silders/SilderData";

function Silder() {
  return <ImageSlider slides={SliderData}/>
}

export default Silder;