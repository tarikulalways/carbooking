import { useLocation } from "react-router-dom"

export const useLocationQuery = (key) => {
    const location = useLocation();
    const params = new URLSearchParams(location.search);

    return {
        getValue: (key) => params.get(key)
    };
}

