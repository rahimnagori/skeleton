/* eslint-disable react/react-in-jsx-scope */
import { RouterProvider } from "react-router-dom";
import router from "./config/Routes";

function App() {
  return <RouterProvider router={router} />;
}

export default App;
