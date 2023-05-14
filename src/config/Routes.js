import { createBrowserRouter } from "react-router-dom";
import AppContainer from "../pages/AppContainer";
import HomePage from "../pages/Home";
import ContactPage from "../pages/Contact";
import AboutPage from "../pages/About";
import ErrorPage from "../pages/Error";

const router = createBrowserRouter([
  {
    path: "/",
    element: <AppContainer />,
    children: [
      { path: "/", element: <HomePage /> },
      { path: "/contact", element: <ContactPage /> },
      { path: "/About", element: <AboutPage /> },
    ],
    errorElement: <ErrorPage />,
  },
]);

/*
Another possible configuration
const routeDefinitions = createRoutesFromElements(
  <Route>
    <Route path="/" element={<HomePage />} />
    <Route path="/contact" element={<ContactPage />} />
    <Route path="/about" element={<AboutPage />} />
  </Route>
);

const router = createBrowserRouter(routeDefinitions);
*/

export default router;
