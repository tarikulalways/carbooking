import { createRoot } from "react-dom/client";
import BackendDashboard from "./containers";

document.addEventListener('DOMContentLoaded', () => {
    const container = document.getElementById('carbooking');
    if(container){
        const root = createRoot(container);
        root.render(<BackendDashboard/>);
    }
});