import { useLocation } from "react-router-dom"

export const useLocationQuery = () => {
    const location = useLocation();
    const params = new URLSearchParams(location.search);

    const getValue = (key) => params.get(key);

    return getValue;
}

