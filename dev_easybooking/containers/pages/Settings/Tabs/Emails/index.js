const Emails = () => {

    const handleSubmit = (e) => {
        console.log(e)
    }


    return(
        <di>
            <from onSubmit={() => handleSubmit(e)} method="post" action="#">
                <div className="mb-3">
                    <label for="email">Your Email:</label>
                    <input name="email"/>
                </div>
                <button type="submit">Save</button>
            </from>
        </di>
    )
}
export default Emails;