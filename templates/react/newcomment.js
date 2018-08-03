// import React from 'react'


class NewComment extends React.Component {

    constructor(){
        super()
        this.state = {
            comment: "",
            post: false

        }
    } 

    render() {
        return (
            <div>
                <form>
                    {this.state.post === false ? <button onClick={this.changeHandler} name="commentbutton">comment</button> :
                    <div>
                        <input onChange={this.changeHandler} name="comment" value={this.state.comment}/>
                        <button type="submit" onClick={this.newComment}>post</button>
                    </div>}
                </form>
            </div>
        )
    }


    changeHandler = (e) => {
        e.preventDefault() 
        // console.log(e.target, "new target")

        var name = e.target.name
        if(name !== "commentbutton"){
            this.setState({
                ...this.state,
                [name]: e.target.value
            })
        }
        else {
            this.setState({
                post: true
            })
        }
    }

    // postComments = async () => {
    //     const response = await fetch('../backend/comments.php', {
    //       method: 'POST',

    //       body: JSON.stringify({comment: this.state.commnt})
    //       //send username too? 
    //     });
    //     const content = await response.json();
      
    //     console.log(content);
    //   }


      //sends an object with the comment to a function in the parent component
    newComment = (e) => {
        e.preventDefault() 
        // this.postComments()
        if(this.state.comment !== ""){
            this.props.addComment ({
                comment: this.state.comment,
                user: "",
                parent_id: "",
                type: "",
                // reply: false
            })

            this.setState({
                comment: "",
                post: false
            })
        }
        else alert("please enter comment")
    }
}

// export default NewComment